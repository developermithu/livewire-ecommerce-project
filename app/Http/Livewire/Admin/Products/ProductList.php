<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // $product->image;
        $product->delete();
        Toastr::success('Product has been deleted');
    }

    public function render()
    {
        $products = Product::latest()->paginate(5);
        return view('livewire.admin.products.product-list', compact('products'))->layout('layouts.backend.app');
    }
}
