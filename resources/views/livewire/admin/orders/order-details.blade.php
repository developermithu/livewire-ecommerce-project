<div>
    <div class="row mx-3">
        <div class="mr-auto" style="font-size: 28px">Order Details</div>
       <a href="{{route('admin.orders')}}" class="btn btn btn-rose">
           <i class="material-icons">add_circle</i> &nbsp;
           Go Back
         <div class="ripple-container"></div><div class="ripple-container"></div>
       </a>
     </div>

     <div class="col-md-12 ">
      <div class="card">
        <div class="card-header card-header-primary card-header-icon">
          <div class="card-icon w-100">
            Order Details
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center">Order Id</th>
                  <th class="text-center">Order Date</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">
                    @if ($order->status == 'delivered')
                        Delivered Date
                    @elseif ($order->status == 'canceled')
                        Canceled Date
                    @endif
                  </th>
                </tr>
              </thead>
              <tbody>
                      <tr>
                          <td class="text-center">{{$order->id}}</td>
                          <td class="text-center">{{$order->created_at}}</td>
                          @if ($order->status == 'delivered')
                            <td class="text-center text-success">
                             {{$order->status}}
                            </td>
                            @elseif ($order->status == 'canceled')
                            <td class="text-center text-danger">
                            {{$order->status}}
                            </td>
                          @endif
                          @if ($order->status == 'delivered')
                            <td class="text-center text-success">
                             {{$order->delevered_date}}
                            </td>
                            @elseif ($order->status == 'canceled')
                            <td class="text-center text-danger">
                            {{$order->canceled_date}}
                            </td>
                          @endif
                      </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon w-100">
                  Order Item Details
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
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
                </div>
                <div class="mx-5">
                    <div class="d-flex justify-content-between">
                        <div> <b>Subtotal</b> </div>
                         <div> ${{$order->subtotal}} </div>
                     </div>
                     <div class="d-flex justify-content-between">
                        <div> <b>Discount</b> </div>
                         <div> ${{$order->discount}} </div>
                     </div>
                     <div class="d-flex justify-content-between">
                        <div> <b>Tax</b> </div>
                         <div> ${{$order->tax}} </div>
                     </div>
                     <div class="d-flex justify-content-between text-rose">
                        <div> <b>Total</b> </div>
                         <div> ${{$order->total}} </div>
                     </div>
                </div>
              </div>
            </div>
      </div>

        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon w-100">
                  Billing Details
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Mobile</th>
                        <th class="text-center">Country</th>
                        <th class="text-center">City</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Post Code</th>
                      </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td class="text-center">{{$order->name}}</td>
                                <td class="text-center">{{$order->email}}</td>
                                <td class="text-center">{{$order->mobile}}</td>
                                <td class="text-center">{{$order->country}}</td>
                                <td class="text-center">{{$order->city}}</td>
                                <td class="text-center">{{$order->line1}} {{$order->lin2}}</td>
                                <td class="text-center">{{$order->zipcode}}</td>
                            </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>

        @if ($order->is_shipping_different == true)
            <div class="col-md-12 ">
                <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon w-100">
                    Shipping Details
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Country</th>
                            <th class="text-center">City</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Post Code</th>
                        </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="text-center">{{$order->shipping->name}}</td>
                                    <td class="text-center">{{$order->shipping->email}}</td>
                                    <td class="text-center">{{$order->shipping->mobile}}</td>
                                    <td class="text-center">{{$order->shipping->country}}</td>
                                    <td class="text-center">{{$order->shipping->city}}</td>
                                    <td class="text-center">{{$order->shipping->line1}} {{$order->shipping->lin2}}</td>
                                    <td class="text-center">{{$order->shipping->zipcode}}</td>
                                </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
        @endif

        <div class="col-md-12 ">
            <div class="card">
              <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon w-100">
                  Transaction Details
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">Transaction Mode</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Transaction Date</th>
                      </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td class="text-center">{{$order->transaction->mode}}</td>
                                <td class="text-center">{{$order->transaction->status}}</td>
                                <td class="text-center">{{$order->transaction->created_at}}</td>
                            </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>

      </div>
</div>
