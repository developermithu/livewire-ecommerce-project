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