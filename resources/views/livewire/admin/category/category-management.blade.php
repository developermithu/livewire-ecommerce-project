<div>
    <div class="row mx-3">
         <div class="mr-auto" style="font-size: 28px">Category List</div>
        <button wire:click.prevent="addNew" class="btn btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="material-icons">add_circle</i> &nbsp;
            Add Category
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
                        <th>Select All</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($categories as $key=>$category)
                      <tr>
                        <td class="text-center">{{$key + 1}}</td>
                        <td>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="">
                                <span class="form-check-sign">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                          </td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td class="td-actions">
                          <button wire:click.prevent="edit({{$category}})" class="btn btn-primary">
                            <i class="material-icons">edit</i>
                          </button> &nbsp;

                          <button wire:click.prevent="confirmRemoval({{$category->id}})" type="button" class="btn btn-rose">
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
              {{ $categories->links() }}
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
              <button type="button" class="btn btn-rose py-2 px-3 mr-3" data-dismiss="modal"> <span class="material-icons mr-1">close</span>No
                <div class="ripple-container"></div></button>

              <button wire:click.prevent="destroy" type="button" class="btn btn-primary py-2">
                <span class="material-icons mr-1">delete</span>
                  Yes!
                <div class="ripple-container"></div></button>
            </div>
          </div>
        </div>
      </div>

</div>

