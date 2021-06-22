<?php
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
use App\Http\Livewire\User\UserReview;
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

    // User Orders
    Route::get('/user/orders', OrderList::class)->name('user.orders');
    Route::get('/user/order/{order_id}', UserOrderDetails::class)->name('user.order.details');
    Route::get('/user/review/{order_item_id}', UserReview::class)->name('user.review');
});

//========= Admin Dashboard
include('admin.php');
