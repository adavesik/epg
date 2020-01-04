<div class="modal fade" id="addEpgUrlModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Channel & URL</h5>
                <span id="add-task-errors"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmAddEpgUrl" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="epg_url_channel">Select Channel</label>
                                <select class="form-control" name="epg_url_channel" id="epg_url_channel">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="epg_url">EPG URL</label>
                                <input type="text" class="form-control" name="epg_url" id="epg_url" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary" id="btn-addUrl">Add Channel</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
