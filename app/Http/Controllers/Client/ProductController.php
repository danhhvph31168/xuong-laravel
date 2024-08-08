<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
        $product = Product::query()->latest('id')->limit(8)->get();
        return view('client.home', compact('product'));
    }
    public function detail($slug)
    {
        $product = Product::query()->with(['variants','galleries','catelogue'])->where('slug', $slug)->first();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        return view('client.product-detail', compact('product', 'colors', 'sizes'));
    }
}
