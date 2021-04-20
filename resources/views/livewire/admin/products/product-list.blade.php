<div>
    <div class="row mx-3">
         <div class="mr-auto" style="font-size: 28px">Product List</div>
        <a href="{{route('admin.products.add')}}" class="btn btn btn-primary">
            <i class="material-icons">add_circle</i> &nbsp;
            Add Product
          <div class="ripple-container"></div>
        </a>
      </div>

      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">local_mall</i>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">S.N.</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Description</th>     
                        <th class="text-center">Price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">SKU</th>
                        <th class="text-center">Stock Status</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $key=>$product)
                      <tr>
                        <td class="text-center">{{$key + 1}}</td>
                        <td>
                            <a href="{{route('product.details', $product->slug)}}" target="_blank">
                            {!! Str::limit($product->name, 10, '...') !!}
                        </a>
                    </td>
                        <td>
                          <a href="{{asset('frontend/assets/images/products')}}/{{$product->image}}" target="_blank">
                          <img src="{{asset('frontend/assets/images/products')}}/{{$product->image}}" alt="photo" width="40px">
                        </a>
                        </td>
                        <td>{{$product->category->name}}</td>
                        <td>{!! Str::limit($product->description, 30, '...') !!}</td>
                        <td>${{$product->regular_price}}</td>
                        <td>{{$product->qty}}</td>
                        <td>{{$product->sku}}</td>
                        <td>
                            @if ($product->stock_status == 'outofstock')
                              <button class="btn btn-sm btn-rose px-2">Out Of Stcok</button>
                            @else
                            <button class="btn btn-sm btn-success px-2">Instock</button>
                            @endif
                        </td>

                        <td class="td-actions">
                          <a href="{{route('admin.products.edit', $product->slug)}}" class="btn btn-primary">
                            <i class="material-icons">edit</i>
                          </a> &nbsp;

                          <button wire:click.prevent="destroy({{$product->id}})" type="button" class="btn btn-rose">
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
              {{ $products->links() }}
            </div>
          </div>
      </div>

       {{-- <!-- Add and Update Model -->
       <div wire:ignore.self class="modal fade" id="form" tabindex="-1" role="dialog" style="display: none; padding-right: 17px; padding-left: 17px;">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                @if ($showEditModal)
                    Update Category
                @else
                    Add New Category
                @endif
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="material-icons">clear</i>
              </button>
            </div>

            <form wire:submit.prevent="{{ $showEditModal ? 'update' : 'create'}}" method="#" action="#">
            <div class="modal-body">
                  <div class="card-body ">
                      <div class="form-group bmd-form-group @error('name') has-danger @enderror">
                        <input type="text" wire:model.defer="state.name" wire:keyup="generateSlug" class="form-control" id="name" placeholder="Category name..">
                        @error('name')
                        <label class="error" for="name">{{$message}}</label>
                        @enderror
                      </div>

                      <div class="form-group bmd-form-group @error('slug') has-danger @enderror">
                        <input type="text" wire:model.defer="state.slug" class="form-control" id="slug" placeholder="Category slug..">
                        @error('slug')
                        <label class="error" for="slug">{{$message}}</label>
                        @enderror
                      </div>
                  </div>
            </div>
            <div class="modal-footer pb-0">            
              <button type="button" class="btn btn-danger py-2 px-3 mr-3" data-dismiss="modal"> <span class="material-icons mr-1">close</span>Close
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
      <div wire:ignore.self class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" style="display: none; padding-right: 17px; padding-left: 17px;">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                Delete Category
              </h5>
            </div>
            <div class="modal-body">
                     Are you sure want to delete this data?
            </div>
            <div class="modal-footer pb-3">            
              <button type="button" class="btn btn-danger py-2 px-3 mr-3" data-dismiss="modal"> <span class="material-icons mr-1">close</span>No
                <div class="ripple-container"></div></button>

              <button wire:click.prevent="destroy" type="button" class="btn btn-primary py-2">
                <span class="material-icons mr-1">delete</span>
                  Yes!
                <div class="ripple-container"></div></button>
            </div>
          </div>
        </div>
      </div> --}}

</div>

