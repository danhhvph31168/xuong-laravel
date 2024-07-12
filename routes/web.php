<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $products = \App\Models\Product::query()->latest('id')->limit(4)->get();

    return view('welcome', compact('products'));
})->name('welcome');


Route::get('/admin', function () {
    return 'This is Admin';
})->middleware('isAdmin');

//Auth::routes();

Route::get('auth/login', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('auth/login', [LoginController::class, 'login']);

Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('auth/register', [RegisterController::class, 'showFormRegister'])->name('register');
Route::post('auth/register', [RegisterController::class, 'register']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('product/{slug}', [ProductController::class, 'detail'])->name('product.detail');

// Mua bán hàng
Route::get('cart/list', [CartController::class, 'list'])->name('cart.list');
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('order/save', [OrderController::class, 'save'])->name('order.save');
