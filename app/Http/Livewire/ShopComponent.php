<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
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

    // For Price Filter
    public $min_price;
    public $max_price;

    public function mount()
    {
        $this->sorting = 'default';
        $this->pageNumber = '12';
        $this->min_price = 1;
        $this->max_price = 1000;
    }

    // from shoppingcart package
    public function store($product_id, $product_name, $product_price)
    {
        // 1 is qty number
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
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

        if ($this->sorting == 'date') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'desc')->simplePaginate($this->pageNumber);
            $sale = Sale::find(1);
        } else if ($this->sorting == 'price') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'asc')->simplePaginate($this->pageNumber);
            $sale = Sale::find(1);
        } else if ($this->sorting == 'price-desc') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'desc')->simplePaginate($this->pageNumber);
            $sale = Sale::find(1);
        } else {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->simplePaginate($this->pageNumber);
            $sale = Sale::find(1);
        }

        // $products = Product::simplePaginate(9);
        $categories = Category::orderBy('name', 'asc')->get();
        return view('livewire.shop-component', compact('products', 'categories', 'sale'))->layout('layouts.frontend.base');
    }
}
