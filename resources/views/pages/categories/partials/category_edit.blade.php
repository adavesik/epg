<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="feather icon-user mr-1"></i>Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmEditCategory">
                @csrf
                <div class="modal-body text-left">
                    <div class="form-group">
                        <label>Category Name</label>
                        <span id="add-task-errors"></span>
                        <input type="text" class="form-control" id="catname" name="catname" placeholder="Enter name">
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="category_id" name="category_id" type="hidden" value="0">
                    <button type="button" class="btn waves-effect waves-light btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-edit" class="btn waves-effect waves-light btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
