<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $categories = Category::take(8)->get();
        $latest_products = Product::latest()->take(8)->get();
        $on_sale_products = Product::where('sale_price', '>', 0)->inRandomOrder()->take(10)->get();
        $sale = Sale::find(1);
        return view('livewire.home-component', compact('latest_products', 'categories', 'on_sale_products', 'sale'))->layout('layouts.frontend.base');
    }
}
