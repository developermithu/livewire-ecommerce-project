<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CategoryManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $showEditModal = false;
    public $category = null;
    public $removeData;

    public function generateSlug()
    {
        $this->state['slug'] = Str::slug($this->state['name']);
    }

    public function addNew()
    {
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function create()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required | string',
            'slug' => 'required | unique:categories',
        ])->validate();

        Category::create($validatedData);

        $this->state = [];
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Category added successfully.']);
        return back();
    }

    public function edit(Category $category)
    {
        // dd($category->toArray());
        $this->showEditModal = true;
        $this->category = $category;
        $this->state = $category->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required | string',
            'slug' => 'required | unique:categories,slug,' . $this->category->id,
        ])->validate();

        $this->category->update($validatedData);

        $this->state = [];
        // $this->slug = '';
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Category updated successfully.']);
        return back();
    }

    public function confirmRemoval($id)
    {
        // dd($id);
        $this->removeData = $id;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function destroy()
    {
        // dd($id);
        $category = Category::findOrFail($this->removeData);
        $category->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Category deleted successfully.']);
    }

    public function render()
    {
        $categories = Category::latest()->paginate(5);
        return view('livewire.admin.category.category-management', compact('categories'))->layout('layouts.backend.app');
    }
}
