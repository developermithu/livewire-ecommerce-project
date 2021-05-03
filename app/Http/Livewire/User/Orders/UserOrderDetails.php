<?php

namespace App\Http\Livewire\User\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class UserOrderDetails extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function cancelOrder()
    {
        $order = Order::findOrFail($this->order_id);
        $order->status = 'canceled';
        $order->canceled_date = Date::now();
        $order->save();
        session()->flash('success', 'Order has been canceled.');
    }

    public function render()
    {
        $order = Order::where('id', $this->order_id)->where('user_id', Auth::id())->first();
        return view('livewire.user.orders.user-order-details', compact('order'))->layout('layouts.frontend.base');
    }
}
