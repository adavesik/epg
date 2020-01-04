$(document).ready(function() {
    var APP_URL = $('meta[name="_base_url"]').attr('content');

    $('#frmAddChannel').on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: APP_URL + '/channels/create',
            data:new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function() {
                $('#frmAddChannel').trigger("reset");
                $("#frmAddChannel .close").click();
                window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                $('#add-task-errors').html('');
                $.each(errors.messages, function(key, value) {
                    $('#add-task-errors').append('<li>' + value + '</li>');
                });
                $("#add-error-bag").show();
            }
        });
    });

    $("#btn-edit").click(function() {
        var form = $("#frmEditChannel").get(0);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: APP_URL + '/channels/channel/' + $("#frmEditChannel input[name=id]").val(),
            data: {
                name_am: $("#frmEditChannel input[name=name_am]").val(),
                name_ru: $("#frmEditChannel input[name=name_ru]").val(),
                name_en: $("#frmEditChannel input[name=name_en]").val(),
                channel_id: $("#frmEditChannel input[name=channel_id]").val(),
                channel_orig_id: $("#frmEditChannel input[name=channel_orig_id]").val(),
            },
            dataType: 'json',
            success: function(data) {
                $('#frmEditChannel').trigger("reset");
                $("#frmEditChannel .close").click();
                window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-task-errors').html('');
                $.each(errors.messages, function(key, value) {
                    $('#edit-task-errors').append('<li>' + value + '</li>');
                });
                $("#edit-error-bag").show();
            }
        });
    });

    $("#btn-delete").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: APP_URL + '/channels/channel/' + $("#frmDeleteChannel input[name=channel_id]").val(),
            dataType: 'json',
            success: function(data) {
                $("#frmDeleteChannel .close").click();
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

/*
* Enable channel
* */
    $("#btn-enable").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: APP_URL + '/channels/enable/channel',
            dataType: 'json',
            data: {
                channel_id: $("#frmEnableChannel input[name=channel_id]").val(),
            },

            success: function(data) {
                $("#frmEnableChannel .close").click();
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });


    $("#check-prog-list").click(function () {
        var info = $('textarea').val();
        var lines = info.split('\n');
        var epgArray ={};
        for(var i = 0; lines.length > i; i++){
            epgArray[i+1] = lines[i];

        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: APP_URL + '/program/check',
            data: {epgtext: JSON.stringify(epgArray)}
        }).done(function(data) {
                console.log(data);
                var errorMessage = "";
                var errors="";
                var tempdata = [];
                $.each(data.message, function (element, value) {
                    errors = errors + "<p>" + value + "</p>";
                    tempdata.push(parseInt(element));
                });

            if(data.error === true) {
                $("#programErrorModalText").html('<div class="alert alert-danger" role="alert">\n' +
                    errors + '\n' +
                    '\t\t\t\t\t\t</div>');
                $('#send-prog-list-to-db').prop('disabled', true);
                $('#programError').modal('show');
            }
                //  console.log(tempdata);
                $(function() {
                    $("#total").html('<textarea class="lined" rows="40" width="100%">' + info + '</textarea>');
                    $(".lined").linedtextarea(
                        {
                            selectedLine: tempdata
                        }
                    );
                });
                if(data.error === false) {
                    $("#programSuccessModalText").html('<div class="alert alert-success" role="alert">\n' +
                        '\t\t\t\t\t\t\t<h4 class="alert-heading">Well done!</h4>\n' +
                        '\t\t\t\t\t\t\t<p>'+data.message+'</p>\n' +
                        '\t\t\t\t\t\t\t<hr>\n' +
                        '\t\t\t\t\t\t</div>');
                    $('#programSuccess').modal('show');
                    $('#send-prog-list-to-db').prop('disabled', false);
                    //alert('Your data were successfully checked !');
                } else {
                    //$("#errorlist").html(errors);
                }

            }
        );
    });



    $("#send-prog-list-to-db").click(function() {

        var proglist = $('.lined').val();
        var channel_id = $("#channel_id").val();
        var prog_date = $("#uploaded-prog-date").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: APP_URL + '/program/save',
            dataType: 'json',
            data:{prog_date:prog_date, channel_id:channel_id, list:proglist},
            success: function(data) {
                $('#pnotify-success').trigger('click');
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    $("#btn-addUrl").click(function() {
        var channel_id = $("#frmAddEpgUrl select[name=epg_url_channel]").val();
        var channelUrl = $("#frmAddEpgUrl input[name=epg_url]").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: APP_URL + '/epg/url/add',
            data:{channel_id:channel_id, url:channelUrl},
            dataType: 'json',
            success: function(data) {
                $("#frmAddEpgUrl .close").click();
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    $("#btn-deleteUrl").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: APP_URL + '/epg/url/delete/' + $("#frmDeleteEpgUrl input[name=channel_id]").val(),
            dataType: 'json',
            success: function(data) {
                $("#frmDeleteEpgUrl .close").click();
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });


    $("#btn-editUrl").click(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: APP_URL + '/epg/url/' + $("#frmEditEpgUrl input[name=id]").val(),
            data: {
                url: $("#frmEditEpgUrl input[name=epg_url]").val(),
            },
            dataType: 'json',
            success: function(data) {
                $('#frmEditEpgUrl').trigger("reset");
                $("#frmEditEpgUrl .close").click();
                window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-task-errors').html('');
                $.each(errors.messages, function(key, value) {
                    $('#edit-task-errors').append('<li>' + value + '</li>');
                });
                $("#edit-error-bag").show();
            }
        });
    });


    $("#btn-fetchUrl").click(function() {

        var channel_id = $("#channel_id").val();
        var url = $(this).data('url');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: APP_URL + '/epg/url/fetch/' + channel_id,
            dataType: 'json',
            success: function(data) {
                $('#pnotify-success').trigger('click');
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

});

function addChannelForm() {
    $(document).ready(function() {
        $("#add-error-bag").hide();
        $('#addChannelModal').modal('show');
    });
}

function editChannelForm(channel_id) {
    var APP_URL = $('meta[name="_base_url"]').attr('content');
    $.ajax({
        type: 'GET',
        url: APP_URL + '/channels/channel/' + channel_id,
        success: function(data) {
            $("#edit-error-bag").hide();
            $("#frmEditChannel input[name=name_am]").val(data.channel.display_name_am);
            $("#frmEditChannel input[name=name_en]").val(data.channel.display_name_en);
            $("#frmEditChannel input[name=name_ru]").val(data.channel.display_name_ru);
            $("#frmEditChannel input[name=channel_id]").val(data.channel.channel_id);
            $("#frmEditChannel input[name=channel_orig_id]").val(data.channel.channel_orig_id);
            $("#frmEditChannel input[name=id]").val(data.channel.id);
            $('#editChannelModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function deleteChannelForm(channel_id) {
    var APP_URL = $('meta[name="_base_url"]').attr('content');
    $.ajax({
        type: 'GET',
        url: APP_URL + '/channels/channel/' + channel_id,
        success: function(data) {
            $("#deleteChannelModal #delete-title").html("Delete Channel (" + data.channel.display_name_am + ")?");
            $("#frmDeleteChannel input[name=channel_id]").val(data.channel.id);
            $('#deleteChannelModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}


function enableChannelForm(channel_id) {
    var APP_URL = $('meta[name="_base_url"]').attr('content');
    $.ajax({
        type: 'GET',
        url: APP_URL + '/channels/channel/' + channel_id,
        success: function(data) {
            $("#enableChannelModal #enable-title").html("Enable Channel (" + data.channel.display_name_am + ")?");
            $("#frmEnableChannel input[name=channel_id]").val(data.channel.id);
            $('#enableChannelModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}

//TODO дороботать
function addEpgUrlForm() {
    var APP_URL = $('meta[name="_base_url"]').attr('content');
    $.ajax({
        type: 'GET',
        url: APP_URL + '/channels/list/',
        success: function(data) {
            $("#edit-error-bag").hide();

            $.each(data.channel, function(i, item) {
                $('<option>').val(item['id']).text(item['display_name_am']).appendTo('#epg_url_channel');
            });
            $('#addEpgUrlModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function deleteEpgUrlForm(channel_id) {
    var APP_URL = $('meta[name="_base_url"]').attr('content');
    $.ajax({
        type: 'GET',
        url: APP_URL + '/channels/channel/' + channel_id,
        success: function(data) {
            $("#deleteEpgUrlModal #delete-title").html("Delete Channel's URL (" + data.channel.display_name_am + ")?");
            $("#frmDeleteEpgUrl input[name=channel_id]").val(data.channel.id);
            $('#deleteEpgUrlModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}


function editEpgUrlForm(channel_id) {
    var APP_URL = $('meta[name="_base_url"]').attr('content');
    $.ajax({
        type: 'GET',
        url: APP_URL + '/channels/channel/' + channel_id,
        success: function(data) {
            $("#edit-error-bag").hide();
            $("#frmEditEpgUrl input[name=epg_url]").val(data.channel.epg_url);
            $("#frmEditEpgUrl input[name=id]").val(data.channel.id);
            $('#editEpgUrlModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function fetchEpgByUrl(channel_id) {
    var APP_URL = $('meta[name="_base_url"]').attr('content');
    $.ajax({
        type: 'GET',
        url: APP_URL + '/epg/url/fetch/' + channel_id,
        success: function(data) {
            swal("Good job!", "XML was grabbed, parsed and inserted into DB!", "success");
        },
        error: function(data) {
            console.log(data);
        }
    });
}
