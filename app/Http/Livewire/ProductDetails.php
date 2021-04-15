<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->take(4)->get();
        $related_products = Product::where('category_id', $product->category_id)->get();

        return view(
            'livewire.product-details',
            compact('product', 'popular_products', 'related_products')
        )
            ->layout('layouts.frontend.base');
    }
}
