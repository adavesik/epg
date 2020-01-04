<div class="modal fade" id="editChannelModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Channel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditChannel" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="name_am">Name in Armenian</label>
                                <input type="text" class="form-control" name="name_am" id="name_am" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="name_en">Name in English</label>
                                <input type="text" class="form-control" name="name_en" id="name_en" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="name_ru">Name in Russian</label>
                                <input type="text" class="form-control" name="name_ru" id="name_ru" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="name_ru">Channel ID</label>
                                <input type="text" class="form-control" name="channel_id" id="channel_id" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="channel_orig_id">Channel Original ID</label>
                                <input type="text" class="form-control" name="channel_orig_id" id="channel_orig_id" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <input id="channel_id" name="id" type="hidden" value="0">
                            <button type="button" class="btn btn-primary" id="btn-edit">Update Channel</button>
                            <button type="button" class="btn waves-effect waves-light btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
