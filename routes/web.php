<?php

use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\Category\CategoryManagement;
use App\Http\Livewire\Admin\Coupons\CouponManagement;
use App\Http\Livewire\Admin\Products\ProductList;
use App\Http\Livewire\Admin\Products\ProductAdd;
use App\Http\Livewire\Admin\Products\ProductUpdate;
use App\Http\Livewire\Admin\SaleTimer;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ProductDetails;
use App\Http\Livewire\SearchResult;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\User\UserDashboard;
use App\Http\Livewire\WishlistComponent;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomeComponent::class);
Route::get('/shop', ShopComponent::class);
Route::get('/cart', CartComponent::class)->name('product.cart');
Route::get('/wishlist', WishlistComponent::class)->name('product.wishlist');
Route::get('/checkout', CheckoutComponent::class);

Route::get('/product/{slug}', ProductDetails::class)->name('product.details');

// shop page by category product
Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');

// shop page by search result
Route::get('/search', SearchResult::class)->name('product.search');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', UserDashboard::class)->name('user.dashboard');
});

Route::middleware(['auth:sanctum', 'verified', 'AuthAdmin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    // Category
    Route::get('/admin/category', CategoryManagement::class)->name('admin.category');
    // Product
    Route::get('/admin/products', ProductList::class)->name('admin.products');
    Route::get('/admin/product/add', ProductAdd::class)->name('admin.products.add');
    Route::get('/admin/product/edit/{product_slug}', ProductUpdate::class)->name('admin.products.edit');
    // Sale Timer
    Route::get('/admin/sale-timer', SaleTimer::class)->name('admin.sale-timer');
    // Coupons
    Route::get('/admin/coupons', CouponManagement::class)->name('admin.coupons');
});
