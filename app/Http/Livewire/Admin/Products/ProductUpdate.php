<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProductUpdate extends Component
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
    public $newImage;
    public $product_id;
    // public $images;

    public function mount($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $this->name =    $product->name;
        $this->slug =  $product->slug;
        $this->sku =  $product->sku;
        $this->regular_price =  $product->regular_price;
        $this->sale_price =  $product->sale_price;
        $this->qty =  $product->qty;
        $this->short_description =  $product->short_description;
        $this->description =  $product->description;
        $this->category_id =  $product->category_id;
        $this->stock_status =  $product->stock_status;
        $this->featured =  $product->featured;
        $this->image =  $product->image;
        $this->product_id =  $product->id;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required | unique:products,name,' . $this->product_id,
            'slug' => 'required | unique:products,slug,' . $this->product_id,
            'sku' => 'required | unique:products,sku,' . $this->product_id,
            'regular_price' => 'required | numeric',
            'sale_price' => 'nullable | numeric',
            'qty' => 'required | numeric',
            'short_description' => 'nullable | string | max:250',
            'description' => 'required | string',
            'category_id' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'newImage' => 'nullable | image | mimes:png,jpg,jpeg | max:1048',
        ]);
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required | unique:products,name,' . $this->product_id,
            'slug' => 'required | unique:products,slug,' . $this->product_id,
            'sku' => 'required | unique:products,sku,' . $this->product_id,
            'regular_price' => 'required | numeric',
            'sale_price' => 'nullable | numeric',
            'qty' => 'required | numeric',
            'short_description' => 'nullable | string | max:250',
            'description' => 'required | string',
            'category_id' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'newImage' => 'nullable | image | mimes:png,jpg,jpeg | max:1048',
            // 'images' => 'nullable | image | mimes:png,jpg,jpeg | max:2048',
        ]);

        $product = Product::find($this->product_id);
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

        if ($this->newImage) {
            $imgName = uniqid() . '.' . $this->newImage->extension();
            $this->newImage->storeAs('media/products', $imgName, 'public');
            $product->image = $imgName;
        }

        $product->save();
        Toastr::success('Product updated successfully');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.products.product-update', compact('categories'))->layout('layouts.backend.app');
    }
}
