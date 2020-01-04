<div class="modal fade" id="enableChannelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enable-title">Enable Channel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmEnableChannel">
                @csrf
                <div class="modal-body text-left">
                    <p>
                        Are you sure you want to enable this channel?
                    </p>
                </div>
                <div class="modal-footer">
                    <input id="channel_id" name="channel_id" type="hidden" value="0">
                    <button type="button" class="btn waves-effect waves-light btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-enable" class="btn waves-effect waves-light btn-danger">Enable</button>
                </div>
            </form>
        </div>
    </div>
</div>
