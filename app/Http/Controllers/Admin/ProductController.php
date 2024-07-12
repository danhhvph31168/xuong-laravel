<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.products.';
    public function index()
    {
        $data = Product::query()->with(['catelogue', 'tags'])->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catelogues = Catelogue::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogues', 'sizes', 'colors', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        list($dataProduct, $dataProductVariants, $dataProductGalleries, $dataTags)
            = $this->handleData($request);

        try {
            DB::beginTransaction();

            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $item) {
                $item += ['product_id' => $product->id];
                ProductVariant::query()->create($item);
            }

            $product->tags()->attach($dataTags);

            foreach ($dataProductGalleries as $item) {
                $item += ['product_id' => $product->id];
                ProductGallery::query()->create($item);
            }

            DB::commit();

            return redirect()->route('admin.products.index')
                ->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            DB::rollBack();

            if (!empty($dataProduct['img_thumbnail']) && Storage::exists($dataProduct['img_thumbnail'])) {
                Storage::delete($dataProduct['img_thumbnail']);
            }

            foreach ($dataProductVariants as $item) {
                if (!empty($item['image']) && Storage::exists($item['image'])) {
                    Storage::delete($item['image']);
                }
            }

            if (!empty($dataProductGalleries['image']) && Storage::exists($dataProductGalleries['image'])) {
                Storage::delete($dataProductGalleries['image']);
            }

            dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product->load([
            'catelogue',
            'tags',
            'galleries',
            'variants',
        ]);

        $catelogues = Catelogue::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'catelogues', 'colors', 'sizes', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        list($dataProduct, $dataProductVariants, $dataProductGalleries, $dataTags, $dataDeleteGalleries)
            = $this->handleData($request);

        try {
            DB::beginTransaction();

            $productImgThumbnailCurrent = $product->img_thumbnail;

            $product->update($dataProduct);

            foreach ($dataProductVariants as $item) {
                $item += ['product_id' => $product->id];
                ProductVariant::query()->updateOrCreate(
                    [
                        'product_id' => $item['product_id'],
                        'product_size_id' => $item['product_size_id'],
                        'product_color_id' => $item['product_color_id'],
                    ], // điều kiện check tồn tại để cập nhật và thêm mới
                    $item
                );
            }

            $product->tags()->sync($dataTags);

            foreach ($dataProductGalleries as $item) {
                $item += ['product_id' => $product->id];
                ProductGallery::query()->updateOrCreate(
                    [
                        'id' => $item['id'],
                    ],
                    $item
                );
            }

            DB::commit();

            if (!empty($dataDeleteGalleries)) {
                foreach ($dataDeleteGalleries as $id => $path) {
                    ProductGallery::query()->where('id', $id)->delete();

                    if (!empty($path) && Storage::exists($path)) {
                        Storage::delete($path);
                    }
                }
            }

            if (
                !empty($productImgThumbnailCurrent) && Storage::exists($productImgThumbnailCurrent)
                && !Storage::exists($product->img_thumbnail)
            ) {
                Storage::delete($productImgThumbnailCurrent);
            }

            return back()->with('success', 'Thao tác thành công!');
        } catch (\Throwable $th) {
            DB::rollBack();

            if (!empty($dataProduct['img_thumbnail']) && Storage::exists($dataProduct['img_thumbnail'])) {
                Storage::delete($dataProduct['img_thumbnail']);
            }

            foreach ($dataProductVariants as $item) {
                if (!empty($item['image']) && Storage::exists($item['image'])) {
                    Storage::delete($item['image']);
                }
            }

            foreach ($dataProductGalleries as $item) {
                if (!empty($item['image']) && Storage::exists($item['image'])) {
                    Storage::delete($item['image']);
                }
            }
            echo 2;
            dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {

            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);

                $product->galleries()->delete();

                foreach ($product->variants as $item) {
                    $item->orderItems()->delete();
                }

                $product->variants()->delete();

                $product->delete();
            }, 3);

            if (!empty($product->img_thumbnail) && Storage::exists($product->img_thumbnail)) {
                Storage::delete($product->img_thumbnail);
            }

            foreach ($product->variants as $item) {
                if (!empty($item['image']) && Storage::exists($item['image'])) {
                    Storage::delete($item['image']);
                }
            }

            foreach ($product->galleries as $item) {
                if (!empty($item['image']) && Storage::exists($item['image'])) {
                    Storage::delete($item['image']);
                }
            }

            return back()->with('success', 'Thao tác thành công');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    private function handleData(Request $request)
    {
        $dataProduct = $request->except('product_variants', 'tags', 'product_galleries');
        $dataProduct['is_active']       ??= 0;
        $dataProduct['is_hot_deal']     ??= 0;
        $dataProduct['is_good_deal']    ??= 0;
        $dataProduct['is_new_deal']     ??= 0;
        $dataProduct['is_show_home']    ??= 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

        if (!empty($dataProduct['img_thumbnail'])) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }

        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);

            $image = !empty($item['image'])
                ? Storage::put('product_variants', $item['image']) : ($item['current_image'] ?? null);

            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
                'image' => $image
            ];
        }

        $dataProductGalleriesTmp = $request->product_galleries ?: [];
        $dataProductGalleries = [];
        foreach ($dataProductGalleriesTmp as $image) {
            if (!empty($image)) {
                $dataProductGalleries[] = [
                    'id' => $item['id'] ?? null,
                    'image' => Storage::put('product_galleries', $image)
                ];
            }
        }

        $dataTags = $request->tags;
        $dataDeleteGalleries = $request->delete_galleries;

        return [$dataProduct, $dataProductVariants, $dataProductGalleries, $dataTags, $dataDeleteGalleries];
    }
}
