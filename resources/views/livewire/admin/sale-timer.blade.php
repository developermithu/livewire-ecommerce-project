<div>
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <strong>{{Session::get('success')}} !</strong>
            </div>
        @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 m-auto">
            <form wire:submit.prevent="update" id="RegisterValidation" novalidate="novalidate">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                        <i class="material-icons">contacts</i>
                        </div>
                        <h4 class="card-title">Set Sale Time</h4>
                    </div>
                    <div class="card-body mt-3">
                            <select  wire:model="status" class="form-control mt-3" >
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>   
                                </select>
                                @error('status')
                                <label class="error">{{$message}}</label>
                                @enderror

                                <div class="form-group bmd-form-group mt-4">
                                    <input type="text" id="sale_time" class="form-control" placeholder="YYY MM DD H:M:S" wire:model="sale_time">
                                    @error('sale_time')
                                    <label class="error">{{$message}}</label>
                                    @enderror
                                </div>

                                <div class="card-footer ml-auto mr-auto pb-0">
                                    <button type="submit" class="btn btn-rose">Submit</button>
                                </div>
                </div>
             </form>
        </div>
    </div>
</div>

@push('js')
<script>
    $(function () {
        $('#sale_time').datetimepicker({
            format : 'Y-MM-DD h:m:s', 
        })
        .on('dp.change', function(e){
            var data = $('#sale_time').val();
            @this.set('sale_time', data);
        });
    });
</script>
@endpush
