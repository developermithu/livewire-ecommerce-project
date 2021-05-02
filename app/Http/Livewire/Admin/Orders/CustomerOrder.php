<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class CustomerOrder extends Component
{
    public function render()
    {
        $orders = Order::latest()->paginate(12);
        return view('livewire.admin.orders.customer-order', compact('orders'))->layout('layouts.backend.app');
    }
}
