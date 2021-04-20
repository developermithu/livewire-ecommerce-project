<div>
    <div class="row">
        <div class="col-md-12">
            <form wire:submit.prevent="update" id="RegisterValidation" novalidate="novalidate" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card ">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <span class="material-icons">
                                    local_mall
                                </span>
                            </div>
                            <h4 class="card-title">Update Product</h4>
                        </div>
                        <div class="card-body ">

                            <div class="form-group bmd-form-group">
                                <input wire:model="name" wire:keyup="generateSlug" type="text" class="form-control">
                                @error('name')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </div>

                            <div class="form-group bmd-form-group">
                                <input wire:model="slug" type="text" class="form-control " placeholder="Slug *" >
                                @error('slug')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </div>

                            <div class="form-group bmd-form-group">
                                <input wire:model="sku" type="text" class="form-control " placeholder="SKU *" >
                                @error('sku')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </div>

                            <div class="form-group bmd-form-group ">
                                <input wire:model="regular_price" type="number" class="form-control" placeholder="Regular Price *">
                                @error('regular_price')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </div>

                            <div class="form-group bmd-form-group ">
                                <input wire:model="sale_price" type="number" class="form-control" placeholder="Sale Price ">
                                @error('sale_price')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </div>

                            <div class="form-group bmd-form-group">
                                <textarea wire:model="short_description" class="form-control" placeholder="Short Description">
                                </textarea>
                                @error('short_description')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </div>

                            <div class="form-group bmd-form-group">
                                <textarea wire:model="description" class="form-control" placeholder="Description *">
                                </textarea>
                                @error('description')
                                <label class="error">{{$message}}</label>
                                @enderror
                            </div>

                            <div class="category form-category text-danger">* Required fields</div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary px-3">
                                <span class="material-icons mr-1">save</span> 
                                Save Changes
                            </button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                     <span class="material-icons">
                                        local_mall
                                    </span>
                                </div>
                                <h4 class="card-title">Update Product</h4> 
                            </div>
                            <div class="card-body ">
                                    <select wire:model="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <label class="text-danger">{{$message}}</label>
                                    @enderror

                                    <select  wire:model.defer="featured" class="form-control mt-3" >
                                        <option value="">Select Featured</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>   
                                      </select>
                                      @error('featured')
                                      <label class="text-danger">{{$message}}</label>
                                      @enderror

                                    <select wire:model="stock_status" class="form-control mt-3">
                                        <option value=""> Select Stcock Status </option>
                                        <option value="instock">Instock</option>
                                        <option value="outofstock">Out Of Stock</option>
                                    </select>
                                    @error('stock_status')
                                    <label class="text-danger">{{$message}}</label>
                                    @enderror

                                    <input wire:model="qty" type="number" class="form-control mt-3" placeholder="Qty Number *">
                                    @error('qty')
                                    <label class="text-danger">{{$message}}</label>
                                    @enderror

                                    <input wire:model="newImage" type="file" class="form-control mt-3">
                                    @error('newImage')
                                    <label class="text-danger">{{$message}}</label>
                                    @enderror

                                    @if ($newImage)
                                        <img src="{{$newImage->temporaryUrl()}}" alt="newImage" width="120px">
                                    @else
                                        <img src="{{asset('frontend/assets/images/products')}}/{{$image}}" alt="image" width="120px">
                                    @endif

                                {{-- <div class="fileinput fileinput-new text-center mt-3" data-provides="fileinput">
                                    {{-- <div class="fileinput-new thumbnail">
                                      <img src="https://via.placeholder.com/200" alt="...">
                                    </div> 
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                      <span class="btn btn-rose btn-file">
                                        <span class="fileinput-new">Upload Product Image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" wire:model.defer="image"/> 
                                      </span>
                                      <a href="#pablo" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                        @error('image')
                                        <label class="text-danger ml-0">{{$message}}</label>
                                        @enderror
                            </div> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>


