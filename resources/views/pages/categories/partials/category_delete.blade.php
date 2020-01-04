<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-title">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmDeleteCategory">
                @csrf
                <div class="modal-body text-left">
                    <p>
                        Are you sure you want to delete this task?
                    </p>
                    <p class="text-warning">
                        <small>
                            This action cannot be undone.
                        </small>
                    </p>
                </div>
                <div class="modal-footer">
                    <input id="category_id" name="category_id" type="hidden" value="0">
                    <button type="button" class="btn waves-effect waves-light btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-delete" class="btn waves-effect waves-light btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
