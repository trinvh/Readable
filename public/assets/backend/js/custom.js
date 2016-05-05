$(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
    e.preventDefault();

    var element = this;

    $(element).popover({
        html: true,
        placement: 'right',
        trigger: 'manual',
        content: function() {
            return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
        }
    });

    $(element).popover('toggle');

    $('#button-image').on('click', function() {
        $('#modal-image').remove();
        $.ajax({
            url: "/admin/filemanager?thumb=" + $(element).attr('id'),
            dataType: 'html',
            beforeSend: function() {
                $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                $('#button-image').prop('disabled', true);
            },
            complete: function() {
                $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
                $('#button-image').prop('disabled', false);
            },
            success: function(html) {
                $('body').append('<div id="modal-image" class="modal">' + html + '</div>');

                $('#modal-image').modal('show');
            }
        });

        $(element).popover('hide');
    });

    $('#button-clear').on('click', function() {
        $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));

        $(element).parent().find('input').attr('value', '');

        $(element).popover('hide');
    });
});

// tooltips on hover
$('[data-toggle=\'tooltip\']').tooltip({
    container: 'body',
    html: true
});

// Makes tooltips work on ajax generated content
$(document).ajaxStop(function() {
    $('[data-toggle=\'tooltip\']').tooltip({
        container: 'body'
    });
});