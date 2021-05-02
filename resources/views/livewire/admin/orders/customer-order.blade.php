<div>
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
                      @foreach ($orders as $key=>$order)
                      <tr>
                        <td class="text-center">{{$key + 1}}</td>
                        <td>${{$order->discount}}</td>
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

                        <td class="td-actions">
                          <a href="{{route('admin.orders.details', $order->id)}}" class="btn btn-primary">
                            <i class="material-icons">visibility</i>
                          </a> &nbsp;

                          <button wire:click.prevent="destroy({{$order->id}})" type="button" class="btn btn-rose">
                            <i class="material-icons">delete</i>
                          </button>
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

