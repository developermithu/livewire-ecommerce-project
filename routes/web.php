<?php

use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\Category\CategoryManagement;
use App\Http\Livewire\Admin\Coupons\CouponManagement;
use App\Http\Livewire\Admin\Orders\CustomerOrder;
use App\Http\Livewire\Admin\Orders\OrderDetails;
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
use App\Http\Livewire\ThankYou;
use App\Http\Livewire\User\Orders\OrderList;
use App\Http\Livewire\User\Orders\UserOrderDetails;
use App\Http\Livewire\User\UserDashboard;
use App\Http\Livewire\WishlistComponent;
use Illuminate\Support\Facades\Route;



Route::get('/', HomeComponent::class);
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/cart', CartComponent::class)->name('product.cart');
Route::get('/wishlist', WishlistComponent::class)->name('product.wishlist');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/thank-you', ThankYou::class)->name('thankyou');
Route::get('/product/{slug}', ProductDetails::class)->name('product.details');

Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');
Route::get('/search', SearchResult::class)->name('product.search');

// User Dashboard
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', UserDashboard::class)->name('user.dashboard');
    // Orders
    Route::get('/user/orders', OrderList::class)->name('user.orders');
    Route::get('/user/order/{order_id}', UserOrderDetails::class)->name('user.order.details');
});

// Admin Dashboard
Route::middleware(['auth:sanctum', 'verified', 'AuthAdmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/category', CategoryManagement::class)->name('admin.category');
    // Product
    Route::get('/admin/products', ProductList::class)->name('admin.products');
    Route::get('/admin/product/add', ProductAdd::class)->name('admin.products.add');
    Route::get('/admin/product/edit/{product_slug}', ProductUpdate::class)->name('admin.products.edit');
    // Sale Timer
    Route::get('/admin/sale-timer', SaleTimer::class)->name('admin.sale-timer');
    Route::get('/admin/coupons', CouponManagement::class)->name('admin.coupons');
    // Customer Order
    Route::get('/admin/orders', CustomerOrder::class)->name('admin.orders');
    Route::get('/admin/order/{order_id}', OrderDetails::class)->name('admin.orders.details');
});
