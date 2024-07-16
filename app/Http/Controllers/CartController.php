<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function list()
    {
        dd(session('cart'));
        $cart = session('cart');

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['quantity'] * ($item['price_sale'] ?: $item['price_regular']);
        }

        return view('cart-list', compact('totalAmount'));
    }
    public function add(Request $request)
    {
        $product = Product::query()->findOrFail(\request('product_id'));
        $productVariant = ProductVariant::query()
            ->with(['color', 'size'])
            ->where([
                'product_id' => \request('product_id'),
                'product_size_id' => \request('product_size_id'),
                'product_color_id' => \request('product_color_id'),
            ])
            ->firstOrFail();


        // session()->forget('cart');
        // dd(session('cart'));
        // die;

        if (!isset(session('cart')[$productVariant->id])) {
            echo 2;

            $data = $product->toArray()
                + $productVariant->toArray()
                + ['quantity' => $request->quantity];

            session()->put('cart.' . $productVariant->id,  $data);
            dd($data);
            // dd(session('cart')[$productVariant->id]);
        } else {
            echo 1;
            $data = session('cart')[$productVariant->id];
            $data['quantity'] = \request('quantity');
            dd($data);
            session()->put('cart.' . $productVariant->id,  $data);
        }

        return redirect()->route('cart.list');
    }
}
