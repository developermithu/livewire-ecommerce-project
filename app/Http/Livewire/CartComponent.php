<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public $haveCouponCode;
    public $applyCode;  //from coupon user form
    public $discount;
    public $subtotal_after_discount;
    public $tax_after_discount;
    public $total_after_discount;

    public function increaseCartQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function decreaseCartQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success', 'Cart item has been removed.');
    }

    public function destroyAll()
    {
        // remove all cart item
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success', 'All cart item has been removed.');
    }

    public function switchToSaveForLater($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);
        session()->flash('success', 'Item switch to save for later.');
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function moveToCart($rowId)
    {
        $item = Cart::instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);
        session()->flash('success', 'Item added to cart.');
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function deleteFromSaveForLater($rowId)
    {
        Cart::instance('saveForLater')->remove($rowId);
        session()->flash('success', 'Item has been deleted from save for later.');
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    //=======  Coupon Applying ==========//
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'applyCode' => 'required'
        ], ['applyCode.required' => 'Field is required']);
    }

    public function applyCouponCode()
    {
        $this->validate([
            'applyCode' => 'required'
        ], ['applyCode.required' => 'Field is required']);

        $coupon = Coupon::where('code', $this->applyCode)
            ->where('expiry_date', '>=', Carbon::today())->first();

        if (!$coupon) {
            session()->flash('coupon_message', 'Opps! coupon code is invalid!');
            return;
        }
        if (Cart::instance('cart')->subtotal() < $coupon->cart_min_price) {
            session()->flash('coupon_message', 'Subtotal price should be greater than $' . $coupon->cart_min_price);
            return;
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_min_price' => $coupon->cart_min_price
        ]);
    }

    // Call this into render method
    public function calculateDiscounts()
    {
        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100;
            }
            // Calculation
            $this->subtotal_after_discount = Cart::instance('cart')->subtotal() - $this->discount;
            $this->tax_after_discount = ($this->subtotal_after_discount * config('cart.tax')) / 100;
            $this->total_after_discount = $this->subtotal_after_discount + $this->tax_after_discount;
        }
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
    }

    public function render()
    {

        if (session()->has('coupon')) {
            if (Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_min_price']) {
                session()->forget('coupon');
            } else {
                $this->calculateDiscounts();
            }
        }

        $sale = Sale::find(1);
        return view('livewire.cart-component', compact('sale'))->layout('layouts.frontend.base');
    }
}
