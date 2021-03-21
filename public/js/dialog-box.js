$('.sweet-multiple').on('click', function() {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!", {
                    icon: "error",
                });
            }
        });
});

function fire(channelName,channelId) {

    swal({
        title: "Are you sure?",
        text: `You want to reset ${channelName} channel!\n When resetting the channel all programs of the channel will be deleted.`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
            if (willDelete) {
               $('.channel-form[data-id='+channelId+']').submit()
            }
        });
}
