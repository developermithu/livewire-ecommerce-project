<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistComponent extends Component
{

    public function moveProductWishlistToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component', 'refreshComponent');
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $wishItem) {
            if ($wishItem->id == $product_id) {
                Cart::instance('wishlist')->remove($wishItem->rowId);
                $this->emitTo('wishlist-count-component', 'refreshComponent');
                // toast('Product added to cart list', 'success');
            }
        }
    }

    public function render()
    {
        return view('livewire.wishlist-component')->layout('layouts.frontend.base');
    }
}
