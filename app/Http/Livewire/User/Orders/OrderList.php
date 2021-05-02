<?php

namespace App\Http\Livewire\User\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderList extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('livewire.user.orders.order-list', compact('orders'))->layout('layouts.frontend.base');
    }
}
