<div>
    <div class="row">
      <div class="col-md-12">
         @if (Session::has('success'))
             <div class="alert alert-success alert-dismissible show" role="alert">
                {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
             </div>
         @endif
      </div>
    </div>

      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon w-100">
                Order List
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr class="text-rose">
                        <th class="text-center">Order No.</th>
                        <th class="text-center">Total Price</th>     
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
                        <td>${{$order->total}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->mobile}}</td>
                        <td>
                            @if ($order->status == 'ordered')
                              <button class="badge badge-default border-0">{{$order->status}}</button>
                            @elseif ($order->status == 'delivered')
                            <button class="badge badge-success border-0">{{$order->status}}</button>
                            @elseif ($order->status == 'canceled')
                            <button class="badge badge-rose border-0">{{$order->status}}</button>
                            @endif   
                        </td>
                        <td>{{Carbon\Carbon::parse($order->created_at)->format('Y-m-d')}}</td>

                        <td class="td-actions d-flex ">
                         <div>
                          <a href="{{route('admin.orders.details', $order->id)}}" class="btn btn-primary">
                            <i class="material-icons">visibility</i>
                          </a>
                        </div> &nbsp; &nbsp;

                          <div class="dropdown pull-left">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="material-icons">build</i>
                                    <span class="caret"></span>
                                  <div class="ripple-container"></div>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; top: 45px; left: -69px; will-change: top, left;">
                                  <li>
                                    <a href="#" wire:click.prevent="updateOrderStatus({{$order->id}}, 'delivered')" >Delivered</a>
                                    <a href="#" wire:click.prevent="updateOrderStatus({{$order->id}}, 'canceled')" >Canceled</a>
                                  </li>
                              </ul>
                          </div>

                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            {{-- pagination --}}
            <div class="d-flex justify-content-end">
              {{ $orders->links() }}
            </div>
          </div>
      </div>
</div>

