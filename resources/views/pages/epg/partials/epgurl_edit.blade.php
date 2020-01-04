<div class="modal fade" id="editEpgUrlModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Channel's URL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditEpgUrl">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="epg_url">URL</label>
                                <input type="text" class="form-control" name="epg_url" id="epg_url" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <input id="channel_id" name="id" type="hidden" value="0">
                            <button type="button" class="btn btn-primary" id="btn-editUrl">Update URL</button>
                            <button type="button" class="btn waves-effect waves-light btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
