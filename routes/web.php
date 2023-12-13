<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikedProductController;
// use App\Http\Controllers\TransactionController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCompletedController;
use App\Http\Controllers\Admin\AdminImageController;
use App\Http\Controllers\Admin\AdminIncomingController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminRekeningController;
use App\Http\Controllers\Admin\AdminSubcategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\OrderMemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestimoniController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Frontend
Route::resource('/', HomeController::class);
Route::resource('home', HomeController::class);
Route::resource('catalog-product', CatalogController::class);
Route::get('catalog-product/sort/{sortType}', [CatalogController::class, 'sort'])->name('catalog.sort');
Route::resource('categories', CategoryController::class);
Route::get('categories/sort/{subcategory}/{sortType}', [CategoryController::class, 'sort'])->name('categories.sort');
Route::post('cart-toggle/{product}', [CartController::class, 'cartToggle'])->name('cart.toggle');
Route::post('like-toggle/{product}', [LikedProductController::class, 'likeToggle'])->name('like.toggle');
Route::post('follow-toggle/{userId}', [FollowController::class, 'follow'])->name('follow');
Route::get('/produk/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
Route::resource('checkout', CheckoutController::class);;
Route::get('/search', [SearchController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{id}', [BlogController::class, 'detail'])->name('blog.detail');

// Login/Register
Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('auth', [LoginController::class, 'auth'])->name('auth');
    Route::resource('register', RegisterController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('/member/profile', ProfileController::class);
    Route::get('/member/referral-code', [ReferralController::class, 'index']);
    Route::get('/member/pesanan-saya', [MyOrderController::class, 'index']);
    Route::get('/member/pesanan-saya/download/{id}', [MyOrderController::class, 'donwload_image'])->name('download');
    Route::get('/member/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::post('/member/produk/accept/{id}', [ProductController::class, 'accept'])->name('produk.accept');
    Route::get('/member/produk/tambah', [ProductController::class, 'create'])->name('produk.create');
    Route::post('/member/produk/post', [ProductController::class, 'store'])->name('produk.store');
    Route::get('/member/produk/edit/{id}', [ProductController::class, 'edit'])->name('member.produk.edit');
    Route::put('/member/produk/update/{id}', [ProductController::class, 'update'])->name('member.produk.update');
    Route::post('/member/produk/delete-image/{id}', [ProductController::class, 'delete_image'])->name('member.image.delete');
    Route::get('/member/pesanan', [OrderMemberController::class, 'index']);

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('cart', CartController::class);
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::resource('liked-product', LikedProductController::class);
    Route::get('liked-product/sort/{sortType}', [LikedProductController::class, 'sort'])->name('like.sort');

    // Backend (admin)
    Route::middleware('check-access:admin')->group(function () {
        Route::resource('admin/dashboard', DashboardController::class);
        Route::resource('admin/account', AdminAccountController::class);
        Route::resource('admin/category', AdminCategoryController::class);
        Route::resource('admin/subcategory', AdminSubcategoryController::class);
        Route::resource('admin/product', AdminProductController::class);
        Route::resource('admin/blog', AdminBlogController::class);
        Route::get('admin/incoming', [AdminIncomingController::class, 'index']);
        Route::get('admin/completed', [AdminCompletedController::class, 'index']);
        Route::resource('admin/rekening', AdminRekeningController::class);
        Route::post('admin/image/{id}', [AdminImageController::class, 'delete'])->name('image.delete');
        Route::get('admin/member-product', [MemberProductController::class, 'index']);
        Route::post('admin/accept-product/{id}', [MemberProductController::class, 'accept'])->name('accept');
        Route::post('admin/denied-product/{id}', [MemberProductController::class, 'denied'])->name('denied');
        Route::post('admin/accept-transaction/{id}', [AdminIncomingController::class, 'accept'])->name('transaction.accept');
        Route::post('admin/denied-transaction/{id}', [AdminIncomingController::class, 'denied'])->name('transaction.denied');
    });
});
