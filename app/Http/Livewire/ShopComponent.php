<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use Toastr;

class ShopComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sorting;
    public $pageNumber;

    public function mount()
    {
        $this->sorting = 'default';
        $this->pageNumber = '12';
    }

    // from shoppingcart package
    public function store($product_id, $product_name, $product_price)
    {
        // 1 is qty number
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success', 'Product added in cart');
        Toastr::success('Product added in cart');
        return redirect()->route('product.cart');
    }


    public function render()
    {

        if ($this->sorting == 'date') {
            $products = Product::orderBy('created_at', 'desc')->simplePaginate($this->pageNumber);
        } else if ($this->sorting == 'price') {
            $products = Product::orderBy('regular_price', 'asc')->simplePaginate($this->pageNumber);
        } else if ($this->sorting == 'price-desc') {
            $products = Product::orderBy('regular_price', 'desc')->simplePaginate($this->pageNumber);
        } else {
            $products = Product::simplePaginate($this->pageNumber);
        }

        // $products = Product::simplePaginate(9);
        $categories = Category::orderBy('name', 'asc')->get();
        return view('livewire.shop-component', compact('products', 'categories'))->layout('layouts.frontend.base');
    }
}
