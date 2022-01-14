$(document).ready(function() {
    loadContact();
    $(document).on('click', '#btn_edit', function() {
        var reservation_id = $(this).closest('tr').find('td:eq(0)').text();
        $.ajax({
            method: "POST",
            url: "/TestCode/modif",
            data: {
                'reservation_id': reservation_id
            },
            success: function(response) {
                //console.log(response);
                $.each(response, function(key, contactvalue) {
                $('#reservation_id').val(contactvalue['id_r']);
                $('#name').val(contactvalue['name']);
                $('#rtype').val(contactvalue['rtype']);
                $('#phone').val(contactvalue['phone']);
                $('.rdate').val(contactvalue['rdate']);
                $('#modalForm').modal('show');
            });
            }
        });
    });
    $(document).on('click', '#btn_update', function() {
        var data = {
            'reservation_id': $('#reservation_id').val(),
            'name': $('#name').val(),
            'phone': $('#phone').val(),
            'rtype': $('#rtype').val(),
            'rdate': $('.rdate').val(),
            'description': $('.description').val(),
        };
        $.ajax({
            method: "POST",
            url: "/TestCode/saveChange",
            data: data,
            success: function(response) {
                $('#modalForm').modal('hide');
                $('.tablecont').html("");
                $('#table').DataTable().ajax.reload();
                alertify.set('notifier', 'position', 'top-right');
                alertify.success(response.status);
            }
        });

    });
    $(document).on('click', '#btn_delete', function() {
        var reservation_id = $(this).closest('tr').find('td:eq(0)').text();
        //alert(contact_id);
        $('#delete_reservation_id').val(reservation_id);
        $('#modalFormDelete').modal('show');


    });
    $(document).on('click', '#delete_btnModal', function() {
        var reservation_id = $('#delete_reservation_id').val();
        $.ajax({
            method: "POST",
            url: "/TestCode/erase",
            data: {
                'reservation_id': reservation_id
            },
            success: function(response) {
                $('#modalFormDelete').modal('hide');
                $('.tablecont').html("");
                $('#table').DataTable().ajax.reload();
                alertify.set('notifier', 'position', 'top-right');
                alertify.success(response.status);
            }
        });

    });
});


function loadContact() {
    $.ajax({
        type: "GET",
        url: "/TestCode/contacts",
        success: function(response) {
            //console.log(response.contact);
            $.each(response.contact, function(key, value) {
                //console.log(value['name']);
                $(".tablecont").append(
                    '<tr>\
                    <td class="reservation_id">' + value['id_r'] + '</td>\
                    <td>' + value['name'] + '</td>\
                    <td>' + value['rtype'] + '</td>\
                    <td>' + value['phone'] + '</td>\
                    <td>' + value['rdate'] + '</td>\
                    <td>\
                    <button type="button" class="btn btn-info" id="btn_edit">Edit</button>\
                    <button type="button" class="btn btn-danger" id="btn_delete">Delete</button>\
                    </td >\</tr> ');
            });
        }
    });


}


