<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{

    public function increaseCartQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function decreaseCartQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success', 'Cart item has been removed.');
    }

    public function destroyAll()
    {
        // remove all cart item
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success', 'All cart item has been removed.');
    }

    public function switchToSaveForLater($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);
        session()->flash('success', 'Item switch to save for later.');
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function moveToCart($rowId)
    {
        $item = Cart::instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);
        session()->flash('success', 'Item added to cart.');
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function deleteFromSaveForLater($rowId)
    {
        Cart::instance('saveForLater')->remove($rowId);
        session()->flash('success', 'Item has been deleted from save for later.');
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function render()
    {
        $sale = Sale::find(1);
        return view('livewire.cart-component', compact('sale'))->layout('layouts.frontend.base');
    }
}
