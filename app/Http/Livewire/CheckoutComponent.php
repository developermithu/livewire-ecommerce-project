<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe;

class CheckoutComponent extends Component
{
    public $ship_to_different;
    public $payment_method;
    public $thankyou;

    public $name, $email, $mobile, $line1, $lin2, $city, $province, $country, $zipcode;

    public $ship_name, $ship_email, $ship_mobile, $ship_line1, $ship_lin2, $ship_city, $ship_province, $ship_country, $ship_zipcode;

    // For Stripe
    public $card_number;
    public $expiry_month;
    public $expiry_year;
    public $cvc;

    public $order_id;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required | min:6',
            'email' => 'required | email',
            'mobile' => 'required | numeric',
            'line1' => 'required',
            'lin2' => 'nullable',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'payment_method' => 'required',
        ]);
        if ($this->ship_to_different) {
            $this->validateOnly($fields, [
                'ship_name' => 'required | min:6',
                'ship_email' => 'required | email',
                'ship_mobile' => 'required | numeric',
                'ship_line1' => 'required',
                'ship_lin2' => 'nullable',
                'ship_city' => 'required',
                'ship_province' => 'required',
                'ship_country' => 'required',
                'ship_zipcode' => 'required',
            ]);
        }
        if ($this->payment_method == 'card') {
            $this->validateOnly($fields, [
                'card_number' => 'required | numeric',
                'expiry_month' => 'required | numeric',
                'expiry_year' => 'required | numeric',
                'cvc' => 'required | numeric',
            ]);
        };
    }

    public function placeOrder()
    {
        $this->validate([
            'name' => 'required | min:6',
            'email' => 'required | email',
            'mobile' => 'required | numeric',
            'line1' => 'required',
            'lin2' => 'nullable',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'payment_method' => 'required',
        ]);
        if ($this->payment_method == 'card') {
            $this->validate([
                'card_number' => 'required | numeric',
                'expiry_month' => 'required | numeric',
                'expiry_year' => 'required | numeric',
                'cvc' => 'required | numeric',
            ]);
        }
        if ($this->ship_to_different) {
            $this->validate([
                'ship_name' => 'required | min:6',
                'ship_email' => 'required | email',
                'ship_mobile' => 'required | numeric',
                'ship_line1' => 'required',
                'ship_lin2' => 'nullable',
                'ship_city' => 'required',
                'ship_province' => 'required',
                'ship_country' => 'required',
                'ship_zipcode' => 'required',
            ]);
        }

        // Payment Method Proccess
        if ($this->payment_method == 'cod') {
            $this->makeOrder();
            $this->makeTransaction('pending');
            $this->resetCart();
        } else if ($this->payment_method == 'card') {
            $stripe = Stripe::make(env('STRIPE_KEY'));
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $this->card_number,   // stripe number
                        'exp_month' => $this->expiry_month,   // stripe exp_month
                        'exp_year' => $this->expiry_year,   // stripe exp_year
                        'cvc' => $this->cvc,   // stripe cvc
                    ]
                ]);
                if (!isset($token['id'])) {
                    session()->flash('stripe_error', 'The stripe token was not generated correctly.');
                    $this->thankyou = 0;
                }
                $customer = $stripe->customers()->create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->mobile,   // stripe phone
                    'address' => [
                        'line1' => $this->line1,
                        'postal_code' => $this->zipcode, // stripe postal_code
                        'city' => $this->city,
                        'state' => $this->province, // stripe state
                        'country' => $this->country,
                    ],
                    'shipping' => [
                        'name' => $this->name,
                        'address' => [
                            'line1' => $this->line1,
                            'postal_code' => $this->zipcode, // stripe postal_code
                            'city' => $this->city,
                            'state' => $this->province, // stripe state
                            'country' => $this->country,
                        ],
                    ],
                    'source' => $token['id']
                ]);
                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'USD',
                    'amount' => session()->get('checkout')['total'],
                    'description' => 'Payment for order no ' . $this->order_id
                ]);
                
                if ($charge['status'] == 'succeeded') {
                    $this->makeOrder();
                    $this->makeTransaction('approved');
                    $this->resetCart();
                } else {
                    session()->flash('stripe_error', 'Error in transaction!');
                    $this->thankyou = 0;
                }
            } catch (Exception $e) {
                session()->flash('stripe_error', $e->getMessage());
                $this->thankyou = 0;
            }
        }
    }

    public function makeOrder()
    {
        // Order Table 
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->discount = session()->get('checkout')['discount'];
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'];
        $order->name = $this->name;
        $order->email = $this->email;
        $order->mobile = $this->mobile;
        $order->line1 = $this->line1;
        $order->lin2 = $this->lin2;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->country = $this->country;
        $order->zipcode = $this->zipcode;
        $order->status = 'ordered';
        $order->is_shipping_different = $this->ship_to_different ? 1 : 0;
        $order->save();
        $this->order_id = $order->id;
        // OrderItem Tables
        foreach (Cart::instance('cart')->content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;  //from upor
            $orderItem->price = $item->price;
            $orderItem->qty = $item->qty;
            $orderItem->save();
        }
        // Shipping Table
        if ($this->ship_to_different) {
            $shipping = new Shipping();
            $shipping->order_id = $order->id; //from upor
            $shipping->name = $this->ship_name;
            $shipping->email = $this->ship_email;
            $shipping->mobile = $this->ship_mobile;
            $shipping->line1 = $this->ship_line1;
            $shipping->lin2 = $this->ship_lin2;
            $shipping->city = $this->ship_city;
            $shipping->province = $this->ship_province;
            $shipping->country = $this->ship_country;
            $shipping->zipcode = $this->ship_zipcode;
            $shipping->save();
        }
    }

    public function resetCart()
    {
        $this->thankyou = 1;
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
    }

    public function makeTransaction($status)
    {
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $this->order_id;
        $transaction->mode = $this->payment_method;
        $transaction->status = $status;
        $transaction->save();
    }

    // Call to render method
    public function verifyForCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } else if ($this->thankyou) {
            return redirect()->route('thankyou');
        } else if (!session()->get('checkout')) {
            return redirect()->route('product.cart');
        }
    }

    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component')->layout('layouts.frontend.base');
    }
}
