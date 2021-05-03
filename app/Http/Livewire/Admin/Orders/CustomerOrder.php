<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class CustomerOrder extends Component
{

    public function updateOrderStatus($order_id, $status)
    {
        $order = Order::findOrFail($order_id);
        $order->status = $status;

        if ($status == 'delivered') {
            $order->delevered_date = Date::now();
        } else if ($status == 'canceled') {
            $order->canceled_date = Date::now();
        }
    
        $order->save();
        session()->flash('success', 'Order status has been updated successfully.');
    }

    public function render()
    {
        $orders = Order::latest()->paginate(12);
        return view('livewire.admin.orders.customer-order', compact('orders'))->layout('layouts.backend.app');
    }
}
