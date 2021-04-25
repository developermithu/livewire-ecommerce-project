<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
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


    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate(Product::class);
        $this->emitTo('wishlist-count-component', 'refreshComponent');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $wishlistItem) {
            if ($wishlistItem->id == $product_id) {
                Cart::instance('wishlist')->remove($wishlistItem->rowId);
                $this->emitTo('wishlist-count-component', 'refreshComponent');
            }
        }
    }

    public function render()
    {
        $category = Category::where('slug', $this->category_slug)->first();
        $category_name = $category->name;

        if ($this->sorting == 'date') {
            $products = Product::where('category_id', $category->id)->orderBy('created_at', 'desc')->simplePaginate($this->pageNumber);
            $sale = Sale::find(1);
        } else if ($this->sorting == 'price') {
            $products = Product::where('category_id', $category->id)->orderBy('regular_price', 'asc')->simplePaginate($this->pageNumber);
            $sale = Sale::find(1);
        } else if ($this->sorting == 'price-desc') {
            $products = Product::where('category_id', $category->id)->orderBy('regular_price', 'desc')->simplePaginate($this->pageNumber);
            $sale = Sale::find(1);
        } else {
            $products = Product::where('category_id', $category->id)->simplePaginate($this->pageNumber);
            $sale = Sale::find(1);
        }

        $categories = Category::orderBy('name', 'asc')->get();
        return view('livewire.category-component', compact('products', 'categories', 'category_name', 'sale'))->layout('layouts.frontend.base');
    }
}
