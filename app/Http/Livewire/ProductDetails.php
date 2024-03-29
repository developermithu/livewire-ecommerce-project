<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductDetails extends Component
{
    public $slug;
    public $qty;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;  //default qty 1
    }

    public function store($product_id, $product_name, $product_price)
    {
        // 1 is qty number
        Cart::instance('cart')->add($product_id, $product_name, $this->qty, $product_price)->associate('App\Models\Product');
        session()->flash('success', 'Product added in cart');
        return redirect()->route('product.cart');
    }

    public function increaseQty()
    {
        $this->qty++;
    }

    public function decreaseQty()
    {
        if ($this->qty > 1) {
            $this->qty--;
        }
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->take(4)->get();
        $related_products = Product::where('category_id', $product->category_id)->get();
        $sale = Sale::find(1);

        return view(
            'livewire.product-details',
            compact('product', 'popular_products', 'related_products', 'sale')
        )
            ->layout('layouts.frontend.base');
    }
}
