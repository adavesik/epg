$(document).ready(function() {
    var APP_URL = $('meta[name="_base_url"]').attr('content');
    $("#btn-add").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'categories/create',
            data: {
                description: $("#catname").val(),
            },
            dataType: 'json',
            success: function(data) {
                $('#frmAddCategory').trigger("reset");
                $("#frmAddCategory .close").click();
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: APP_URL + '/categories/category/' + $("#frmEditCategory input[name=category_id]").val(),
            data: {
                description: $("#frmEditCategory input[name=catname]").val(),
            },
            dataType: 'json',
            success: function(data) {
                $('#frmEditCategory').trigger("reset");
                $("#frmEditCategory .close").click();
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
            url: APP_URL + '/categories/category/' + $("#frmDeleteCategory input[name=category_id]").val(),
            dataType: 'json',
            success: function(data) {
                $("#frmDeleteCategory .close").click();
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
});

function addCategoryForm() {
    $(document).ready(function() {
        $("#add-error-bag").hide();
        $('#addChannelModal').modal('show');
    });
}

function editCategoryForm(category_id) {
    var APP_URL = $('meta[name="_base_url"]').attr('content');
    $.ajax({
        type: 'GET',
        url: APP_URL + '/categories/category/' + category_id,
        success: function(data) {
            $("#edit-error-bag").hide();
            $("#frmEditCategory input[name=catname]").val(data.category.description);
            $("#frmEditCategory input[name=category_id]").val(data.category.id);
            $('#editCategoryModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function deleteCategoryForm(category_id) {
    var APP_URL = $('meta[name="_base_url"]').attr('content');
    $.ajax({
        type: 'GET',
        url: APP_URL + '/categories/category/' + category_id,
        success: function(data) {
            $("#deleteCategoryModal #delete-title").html("Delete Category (" + data.category.description + ")?");
            $("#frmDeleteTask input[name=category_id]").val(data.category.id);
            $('#deleteCategoryModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}
