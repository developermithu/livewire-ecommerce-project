<div>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"> Order List </div>
                            <div class="col-md-6">  
                                <a href="{{route('user.orders')}}" class="btn btn-danger pull-right"> All Orders </a>
                             </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Product Image</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Total Price</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{asset('storage/media/products/' .$orderItem->product->image)}}" alt="products" width="100px">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('product.details', $orderItem->product->slug)}}">{{$orderItem->product->name}}</a>
                                    </td>
                                    <td class="text-center">${{$orderItem->price}}</td>
                                    <td class="text-center">{{$orderItem->qty}}</td>
                                    <td class="text-center">${{$orderItem->price * $orderItem->qty}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="summary">
                            <div class="order-summary">
                                <h4>Order Summary</h4>
                                <p class="summary-info"><span class="title">Subtotal</span>
                                    <b class="index">${{$order->subtotal}}</b>
                                </p>
                                <p class="summary-info"><span class="title">Discount</span>
                                    <b class="index">${{$order->discount}}</b>
                                </p>
                                <p class="summary-info"><span class="title">Tax</span>
                                    <b class="index">${{$order->tax}}</b>
                                </p>
                                <p class="summary-info"><span class="title">Total</span>
                                    <b class="index">${{$order->total}}</b>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Billing Address
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <td>{{$order->name}}</td>
                                <th>Email</th>
                                <td>{{$order->email}}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{$order->mobile}}</td>
                                <th>Country</th>
                                <td>{{$order->country}}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{$order->city}}</td>
                                <th>Province</th>
                                <td>{{$order->province}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{$order->line1}} {{$order->lin2}}</td>
                                <th>Post Code</th>
                                <td>{{$order->zipcode}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if ($order->is_shipping_different)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Shipping Address
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <td>{{$order->shipping->name}}</td>
                                <th>Email</th>
                                <td>{{$order->shipping->email}}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{$order->shipping->mobile}}</td>
                                <th>Country</th>
                                <td>{{$order->shipping->country}}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{$order->shipping->city}}</td>
                                <th>Province</th>
                                <td>{{$order->shipping->province}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{$order->shipping->line1}} {{$order->shipping->lin2}}</td>
                                <th>Post Code</th>
                                <td>{{$order->shipping->zipcode}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Transaction Details
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Transaction Mode</th>
                                <td>{{$order->transaction->mode}}</td>
                            </tr>
                            <tr>
                                <th>Transaction Status</th>
                                <td>{{$order->transaction->status}}</td>
                            </tr>
                            <tr>   
                                <th>Transaction Date</th>
                                <td>{{$order->transaction->created_at}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
