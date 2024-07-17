<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Articles;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {

    // Lấy tất cả các bình luận của một bài viết cụ thể theo kiểu chỏ sang relation
    // $article = Articles::query()->find(1);
    // $article->comments()->create(['content' => 'trump may v', 'user_id' => 1]);
    // dd($article->comments);

    // Lấy tất cả các đánh giá của một video cụ thể  theo kiểu chỏ sang relation
    // $video = Video::query()->find(1);
    // dd($video->ratings);

    // Lấy tất cả các bình luận của một người dùng cụ thể (có thể dùng join or sử dụng relation)
    // $user = User::query()->find(4);
    // dd($user->comments);

    // Lấy trung bình đánh giá của một bài viết cụ thể.
    // $article = Articles::query()->find(2);
    // dd($article->ratings()->avg('rating'));

    //  Lấy tất cả các bài viết, video, và hình ảnh được bình luận bởi một người dùng cụ thể
    // $user = User::query()->find(1);
    // $userComment = $user->comments;
    // $filter = $userComment->filter(fn ($value, $key) => $value['commentable_type'] == 'App\Models\Video');
    // dd($filter);

    // Lấy danh sách các bài viết, video, và hình ảnh có đánh giá trung bình cao nhất.
    $topRatedArticles = Articles::with(['ratings' => function ($query) {
        $query->select(DB::raw('ratingable_id, AVG(rating) as average_rating'))
            ->groupBy('ratingable_id')
            ->orderByDesc('average_rating')
            ->take(5);
    }])->get();
    foreach ($topRatedArticles as $item) {
        echo $item->ratings->first()->average_rating . PHP_EOL;
    }
    die;

    $topRatedVideo = Video::with(['ratings' => function ($query) {
        $query->select(DB::raw('ratingable_id, AVG(rating) as average_rating'))
            ->groupBy('ratingable_id')
            ->orderByDesc('average_rating');
    }])->get();
    dd($topRatedVideo);
    die;

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
