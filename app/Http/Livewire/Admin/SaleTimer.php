<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sale;
use Brian2694\Toastr\Facades\Toastr;
use Livewire\Component;

class SaleTimer extends Component
{
    public $sale_time;
    public $status;

    public function mount()
    {
        $sale = Sale::find(1);
        $this->sale_time = $sale->sale_time;
        $this->status = $sale->status;
    }

    public function update()
    {
        $sale = Sale::find(1);
        $sale->sale_time = $this->sale_time;
        $sale->status = $this->status;
        $sale->save();
        Toastr::success('Sale time updated');
        session()->flash('success', 'Sale time has been changed');
    }

    public function render()
    {
        return view('livewire.admin.sale-timer')->layout('layouts.backend.app');
    }
}
