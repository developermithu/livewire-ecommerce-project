<div>
    <div class="row mx-3">
         <div class="mr-auto" style="font-size: 28px">Coupon List</div>
        <button wire:click.prevent="addNew" class="btn btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="material-icons">add_circle</i> &nbsp;
            Add Coupon
          <div class="ripple-container"></div><div class="ripple-container"></div>
        </button>
      </div>

      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">list</i>
                </div>
                {{-- <h4 class="card-title">Category List</h4> --}}
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">S.N.</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Cart Min Price</th>
                        <th>Expiray Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($coupons as $key=>$coupon)
                      <tr>
                        <td class="text-center">{{$key + 1}}</td>
                        <td>{{$coupon->code}}</td>
                        <td class="text-uppercase">
                            @if ($coupon->type == 'fixed')
                                <span class="badge badge-primary"> {{$coupon->type}} </span>
                            @else 
                            <span class="badge badge-info">{{$coupon->type}}</span>
                            @endif
                        </td>
                        <td>
                            @if ($coupon->type == 'fixed')
                                 ${{$coupon->value}}
                            @else 
                                 {{$coupon->value}} %
                            @endif
                        </td>
                        <td>${{$coupon->cart_min_price}}</td>
                        <td>
                            @if ($coupon->expiry_date < Carbon\Carbon::today())
                               <span class="text-danger"> {{$coupon->expiry_date}} </span>
                            @else
                            {{$coupon->expiry_date}}
                            @endif
                           
                        </td>
                        <td class="td-actions">
                          <button wire:click.prevent="edit({{$coupon}})" class="btn btn-primary">
                            <i class="material-icons">edit</i>
                          </button> &nbsp;

                          <button wire:click.prevent="confirmRemoval({{$coupon->id}})" type="button" class="btn btn-rose">
                            <i class="material-icons">delete</i>
                          </button>
                        </td>
                      </tr>
                      @empty 
                        <tr>
                            <td colspan="7" class="text-center"> <h3>Data not found</h3> </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            {{-- pagination --}}
            <div class="d-flex justify-content-end">
              {{ $coupons->links() }}
            </div>

          </div>
      </div>

       <!-- Add and Update Model -->
       <div wire:ignore.self class="modal fade" id="form" tabindex="-1" role="dialog" style="display: none; padding-right: 17px; padding-left: 17px;">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                @if ($showEditModal)
                    Update Coupon
                @else
                    Add New Coupon
                @endif
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="material-icons">clear</i>
              </button>
            </div>

            <form wire:submit.prevent="{{ $showEditModal ? 'update' : 'create'}}">
            <div class="modal-body">
                  <div class="card-body ">
                      
                       <select class="form-control" wire:model="state.type">
                        <option value="">Select Coupon Type</option>
                        <option value="fixed">Fixed</option>
                        <option value="percent">Percent</option>    
                       </select>
                       @error('type')
                       <label class="text-danger" for="code">{{$message}}</label>
                       @enderror
                   
                      <div class="form-group bmd-form-group mt-3">
                        <input type="text" wire:model.defer="state.code" class="form-control" id="code" placeholder="Coupon code..">
                        @error('code')
                        <label class="error" for="code">{{$message}}</label>
                        @enderror
                      </div>

                      <div class="form-group bmd-form-group">
                        <input type="text" wire:model.defer="state.value" class="form-control" id="value" placeholder="Coupon value..">
                        @error('value')
                        <label class="error" for="value">{{$message}}</label>
                        @enderror
                      </div>

                      <div class="form-group bmd-form-group">
                        <input type="text" wire:model.defer="state.cart_min_price" class="form-control" id="cart_min_price" placeholder="Cart min price..">
                        @error('cart_min_price')
                        <label class="error" for="cart_min_price">{{$message}}</label>
                        @enderror
                      </div>
                      
                      <div class="form-group bmd-form-group mt-4">
                        <input type="text" id="expiry_date" class="form-control" placeholder="Y MM DD" wire:model="state.expiry_date">
                        @error('expiry_date')
                        <label class="error">{{$message}}</label>
                        @enderror
                    </div>

                  </div>
            </div>
            <div class="modal-footer pb-0">            
              <button type="button" class="btn btn-rose py-2 px-3 mr-3" data-dismiss="modal"> <span class="material-icons mr-1">close</span>Close
                <div class="ripple-container"></div></button>

              <button type="submit" class="btn btn-primary py-2">
                <span class="material-icons mr-1">save</span>
                @if ($showEditModal)
                   <span> Save Changes </span>
                @else
                   <span> Submit </span>
                @endif
                <div class="ripple-container"></div></button>
            </div>
            </form>
            
          </div>
        </div>
      </div>

      <!-- Delete Model -->
      <x-delete-model/>
      <!-- Delete Model -->
    
</div>

@push('js')
<script>
    $(function () {
        $('#expiry_date').datetimepicker({
            format : 'Y-MM-DD', 
        })
        .on('dp.change', function(e){
            var data = $('#expiry_date').val();
            @this.set('state.expiry_date', data);
        });
    });
</script>
@endpush