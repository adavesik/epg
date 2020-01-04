<div class="modal fade" id="addChannelModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Channel</h5>
                <span id="add-task-errors"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmAddChannel" enctype="multipart/form-data">
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
                                <label class="floating-label" for="name_ru">Name in Russina</label>
                                <input type="text" class="form-control" name="name_ru" id="name_ru" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="channel_id">Channel ID</label>
                                <input type="text" class="form-control" name="channel_id" id="channel_id" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="utc_offset">Channel's UTC offset (+0400)</label>
                                <input type="text" class="form-control" name="utc_offset" id="utc_offset" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="channel_orig_id">Channel Original ID</label>
                                <input type="text" class="form-control" name="channel_orig_id" id="channel_orig_id" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group fill">
                                <label class="floating-label" for="Icon">Cahnnel logo</label>
                                <input type="file" class="form-control" name="logo" id="Icon" placeholder="sdf">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary" id="btn-add">Add Channel</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
