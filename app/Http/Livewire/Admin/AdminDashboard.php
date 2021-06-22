<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $data['products'] = Product::count();
        $data['category'] = Category::count();
        $data['users'] = User::count();
        $data['orders'] = Order::where('status', 'delivered')->count();

        return view('livewire.admin.admin-dashboard', $data)->layout('layouts.backend.app');
    }
}
