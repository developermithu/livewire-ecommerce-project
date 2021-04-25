<?php

namespace App\Http\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class CouponManagement extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $showEditModal = false;
    public $coupon = null;
    public $removeData;

    public function addNew()
    {
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function create()
    {
        $validatedData = Validator::make($this->state, [
            'code' => 'required | unique:coupons',
            'type' => 'required',
            'value' => 'required',
            'cart_min_price' => 'required',
            'expiry_date' => 'required',
        ])->validate();

        Coupon::create($validatedData);

        $this->state = [];
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Coupon added successfully.']);
        return back();
    }

    public function edit(Coupon $coupon)
    {
        // dd($coupon->toArray());
        $this->showEditModal = true;
        $this->state = $coupon->toArray();
        $this->coupon = $coupon;
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {
        $validatedData = Validator::make($this->state, [
            'code' => 'required | unique:coupons,code,' . $this->coupon->id,
            'type' => 'required',
            'value' => 'required',
            'cart_min_price' => 'required',
            'expiry_date' => 'required',
        ])->validate();

        $this->coupon->update($validatedData);

        $this->state = [];
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Coupon updated successfully.']);
        return back();
    }

    public function confirmRemoval($id)
    {
        $this->removeData = $id;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function destroy()
    {
        Coupon::findOrFail($this->removeData)->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Coupon deleted successfully.']);
    }

    public function render()
    {
        $coupons = Coupon::latest()->paginate(5);
        return view('livewire.admin.coupons.coupon-management', compact('coupons'))->layout('layouts.backend.app');
    }
}
