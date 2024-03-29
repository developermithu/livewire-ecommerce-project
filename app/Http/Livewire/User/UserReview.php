<?php

namespace App\Http\Livewire\User;

use App\Models\OrderItem;
use App\Models\Review;
use Livewire\Component;

class UserReview extends Component
{
    public $order_item_id;
    public $rating;
    public $comment;

    public function mount($order_item_id)
    {
        $this->order_item_id = $order_item_id;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'rating' => 'required',
            'comment' => 'required',
        ]);
    }

    public function addReview()
    {
        $this->validate([
            'rating' => 'required',
            'comment' => 'required',
        ]);

        $review = new Review();
        $review->rating = $this->rating;
        $review->comment = $this->comment;
        $review->order_item_id = $this->order_item_id;
        $review->save();

        $orderItem = OrderItem::findOrFail($this->order_item_id);
        $orderItem->review_status = true;
        $orderItem->save();
        session()->flash('success', 'Review has been added successfully.');
        return redirect()->route('user.orders');
    }

    public function render()
    {
        $orderItem = OrderItem::findOrFail($this->order_item_id);
        return view('livewire.user.user-review', compact('orderItem'))->layout('layouts.frontend.base');
    }
}
