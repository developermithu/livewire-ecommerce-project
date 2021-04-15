<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $products = Product::simplePaginate(9);
        return view('livewire.shop-component', compact('products'))->layout('layouts.frontend.base');
    }
}
