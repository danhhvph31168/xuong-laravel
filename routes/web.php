<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// home
Route::get('/',                 [ProductController::class, 'list'])->name('home');
Route::get('product/{slug}',    [ProductController::class, 'detail'])->name('product.detail');

// admin
Route::get('/admin', function () {
    return 'This is Admin';
})->middleware('isAdmin');

Auth::routes();

// auth
Route::get('auth/login',        [LoginController::class, 'showFormLogin'])->name('login');
Route::post('auth/login',       [LoginController::class, 'login']);

Route::get('auth/logout',      [LoginController::class, 'logout'])->name('logout');

Route::get('auth/register',     [RegisterController::class, 'showFormRegister'])->name('register');
Route::post('auth/register',    [RegisterController::class, 'register']);

// Cart
Route::get('cart/list',                 [CartController::class, 'list'])->name('cart.list');
Route::post('cart/add',                 [CartController::class, 'add'])->name('cart.add');
Route::delete('cart/deleteItem/{slug}', [CartController::class, 'deleteItem'])->name('cart.deleteItem');

// Order
Route::get('order/check-out',   [OrderController::class, 'checkOut'])->name('order.check-out');
Route::post('order/save',       [OrderController::class, 'save'])->name('order.save');

// Test
