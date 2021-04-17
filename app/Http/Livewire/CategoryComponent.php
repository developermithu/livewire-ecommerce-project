<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use Toastr;

class CategoryComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sorting;
    public $pageNumber;
    public $category_slug;

    public function mount($category_slug)
    {
        $this->sorting = 'default';
        $this->pageNumber = '12';
        $this->category_slug = $category_slug;
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
        $category = Category::where('slug', $this->category_slug)->first();
        $category_name = $category->name;
        
        if ($this->sorting == 'date') {
            $products = Product::where('category_id', $category->id)->orderBy('created_at', 'desc')->simplePaginate($this->pageNumber);
        } else if ($this->sorting == 'price') {
            $products = Product::where('category_id', $category->id)->orderBy('regular_price', 'asc')->simplePaginate($this->pageNumber);
        } else if ($this->sorting == 'price-desc') {
            $products = Product::where('category_id', $category->id)->orderBy('regular_price', 'desc')->simplePaginate($this->pageNumber);
        } else {
            $products = Product::where('category_id', $category->id)->simplePaginate($this->pageNumber);
        }

        $categories = Category::orderBy('name', 'asc')->get();
        return view('livewire.category-component', compact('products', 'categories', 'category_name'))->layout('layouts.frontend.base');
    }
}
