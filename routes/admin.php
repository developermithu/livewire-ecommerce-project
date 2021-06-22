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
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin',  'as' => 'admin.',  'middleware' => ['auth', 'verified', 'AuthAdmin']], function () {

    Route::get('dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('category', CategoryManagement::class)->name('category');

    // Product
    Route::get('products', ProductList::class)->name('products');
    Route::get('product/add', ProductAdd::class)->name('products.add');
    Route::get('product/edit/{product_slug}', ProductUpdate::class)->name('products.edit');

    // Sale Timer
    Route::get('sale-timer', SaleTimer::class)->name('sale-timer');

    // Coupons
    Route::get('coupons', CouponManagement::class)->name('coupons');

    // Customer Order
    Route::get('orders', CustomerOrder::class)->name('orders');
    Route::get('order/{order_id}', OrderDetails::class)->name('orders.details');
});
