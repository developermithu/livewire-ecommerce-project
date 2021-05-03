<div>
    <div class="container" style="padding: 30px 0">
        
            @if (Session::has('success'))
                <div class="row">
                        <div class="col-md-12">
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    </div>
                </div>
            @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Order List
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Order No.</th>
                                    <th class="text-center">Discount</th>
                                    <th class="text-center">Total</th>     
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{$order->id}}</td>
                                    <td>${{$order->discount}}</td>
                                    <td>${{$order->total}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->email}}</td>
                                    <td>{{$order->mobile}}</td>
                                    <td>
                                        @if ($order->status == 'ordered')
                                        <button class="btn text-capitalize btn-sm btn-secondary">{{$order->status}}</button>
                                        @elseif ($order->status == 'delivered')
                                        <button class="btn text-capitalize btn-sm btn-success">{{$order->status}}</button>
                                        @elseif ($order->status == 'canceled')
                                        <button class="btn text-capitalize btn-sm btn-danger">{{$order->status}}</button>
                                        @endif   
                                    </td>
                                    <td>{{Carbon\Carbon::parse($order->created_at)->format('Y-m-d')}}</td>

                                    <td class="td-actions">
                                        <a href="{{route('user.order.details', $order->id)}}" class="btn btn-info">
                                            Details
                                        </a>
                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
