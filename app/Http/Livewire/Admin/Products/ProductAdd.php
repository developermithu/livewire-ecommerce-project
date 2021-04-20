<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ProductAdd extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $sku;
    public $regular_price;
    public $sale_price;
    public $qty;
    public $short_description;
    public $description;
    public $category_id;
    public $stock_status;
    public $featured;
    public $image;
    // public $images;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function create()
    {
        $this->validate([
            'name' => 'required | unique:products',
            'slug' => 'required | unique:products',
            'sku' => 'required | unique:products',
            'regular_price' => 'required | numeric',
            'sale_price' => 'sometimes | numeric',
            'qty' => 'required | numeric',
            'short_description' => 'nullable | string | max:250',
            'description' => 'required | string',
            'category_id' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'image' => 'required | image | max:2048',
            // 'images' => 'nullable | image | mimes:png,jpg,jpeg | max:2048',
        ]);

        // if (!Storage::disk('public')->exists('media/products')) {
        //     Storage::disk('public')->makeDirectory('media/products');
        // }
        // Storage::disk('public')->put('media/products/' . $imgName, 'public');
        // 'root' => public_path('frontendassets/images'), in filesystem

        $product = new Product();
        $product->name                      =     $this->name;
        $product->slug                      =      $this->slug;
        $product->sku                          =      $this->sku;
        $product->regular_price         =      $this->regular_price;
        $product->sale_price               =      $this->sale_price;
        $product->qty                            =      $this->qty;
        $product->short_description  =      $this->short_description;
        $product->description              =      $this->description;
        $product->category_id             =      $this->category_id;
        $product->stock_status           =      $this->stock_status;
        $product->featured                    =      $this->featured;

        if ($this->image) {
            $imgName = uniqid() . '.' . $this->image->extension();
            $this->image->storeAs('products', $imgName);
            $product->image = $imgName;
        }

        $product->save();

        Toastr::success('Product added successfully');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('livewire.admin.products.product-add', compact('categories'))->layout('layouts.backend.app');
    }
}
