<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{

    public function increaseCartQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
    }

    public function decreaseCartQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        session()->flash('success', 'Cart item has been removed.');
    }

    public function destroyAll()
    {
        // remove all cart item
        Cart::destroy();
        session()->flash('success', 'All cart item has been removed.');
    }

    public function render()
    {
        $sale = Sale::find(1);
        return view('livewire.cart-component', compact('sale'))->layout('layouts.frontend.base');
    }
}
