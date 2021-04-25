@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" />
@endpush

<div>
    <div class="row">
        <div class="col-md-12">
            <form wire:submit.prevent="create" id="RegisterValidation" novalidate="novalidate" enctype="multipart/form-data" >
                <div class="row">
                    <div class="col-md-8">
                        <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                            <i class="material-icons">people</i>
                            </div>
                            <h4 class="card-title">Add New Product</h4>
                        </div>
                        <div class="card-body ">

                            {{-- <div class="form-group bmd-form-group">
                                <label for="name" class="bmd-label-floating"> Name * </label>
                                <input type="text" wire:model="name" class="form-control" id="name" required="true" aria-required="true">
                            </div> --}}

                            <div class="form-group bmd-form-group">
                                <input wire:model="name" wire:keyup="generateSlug" type="text" class="form-control " placeholder="Name *" >
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

                            <div wire:ignore>
                                <div class="form-group bmd-form-group">
                                    <textarea wire:model="short_description" id="short_description" class="form-control" placeholder="Short Description">
                                    </textarea>
                                </div>
                            </div>
                            @error('short_description')
                            <label class="text-danger">{{$message}}</label>
                            @enderror

                            <div wire:ignore>
                                <div class="form-group bmd-form-group">
                                    <textarea wire:model="description" id="description" class="form-control" placeholder="Description *">
                                    </textarea>
                                </div>
                            </div>
                            @error('description')
                            <label class="text-danger">{{$message}}</label>
                            @enderror

                            <div class="category form-category text-danger">* Required fields</div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-rose">Submit</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                <i class="material-icons">contacts</i>
                                </div>
                                {{-- <h4 class="card-title">Login Form</h4> --}}
                            </div>
                            <div class="card-body">

                                        <select wire:model="category_id" class="form-control">
                                            <option> Select Category </option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>       
                                        @error('category_id')
                                        <label class="text-danger">{{$message}}</label>
                                        @enderror

                                    <select  wire:model="featured" class="form-control mt-3" >
                                        <option value="0">Featured</option>
                                        <option value="1">Non-Featured</option>   
                                      </select>

                                    <select wire:model="stock_status" class="form-control mt-3" style="width: 100%">
                                        <option value="instock">InStock</option>
                                        <option value="outofstock">Out Of Stock</option>
                                    </select> 

                                    <div class="form-group bmd-form-group">
                                        <input wire:model="qty" type="number" class="form-control " placeholder="Qty *" >
                                        @error('qty')
                                        <label class="error">{{$message}}</label>
                                        @enderror
                                    </div>

                               <div class="fileinput fileinput-new text-center mt-3 m-auto" data-provides="fileinput" wire:ignore>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                        <span class="btn btn-primary btn-file text-center">
                                            <span class="fileinput-new">
                                                <span class="material-icons mr-2">image </span>
                                                Upload Product Image
                                            </span>
                                            <span class="fileinput-exists">Change</span>
                                            <input wire:model="image" type="file" class="form-control mt-3">
                                        </span>
                                        <a href="#pablo" class="btn btn-rose fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div> 
                                </div> 
                                @error('image')
                                <label class="text-danger ml-0">{{$message}}</label>
                                @enderror
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
<script>
    $(document).ready(function() {
         $('#description').summernote({
                    minHeight: 160,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('description', contents);
                        }
                    }
          });
         $('#short_description').summernote({
                    minHeight: 100,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('short_description', contents);
                        }
                    }
          });
    });
</script>
@endpush