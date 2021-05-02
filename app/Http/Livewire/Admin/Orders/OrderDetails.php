<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderDetails extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order = Order::findOrFail($this->order_id);
        return view('livewire.admin.orders.order-details', compact('order'))->layout('layouts.backend.app');
    }
}
