$(document).ready(function() {
    loadContact();

    $(document).on('click', '#btn_edit', function() {
        var contact_id = $(this).closest('tr').find('td:eq(0)').text();
        $.ajax({
            method: "POST",
            url: "/TestCode/edit",
            data: {
                'contact_id': contact_id
            },
            success: function(response) {
                console.log(response);
                $.each(response, function(key, contactvalue) {
                    $('#contact_id').val(contactvalue['id']);
                    $('#name').val(contactvalue['name']);
                    $('#ctype').val(contactvalue['ctype']);
                    $('#phone').val(contactvalue['phone']);
                    $('.bday').val(contactvalue['bday']);
                    $('#modalForm').modal('show');


                });
            }
        });
    });
    $(document).on('click', '#btn_update', function() {
        var data = {
            'contact_id': $('#contact_id').val(),
            'name': $('#name').val(),
            'phone': $('#phone').val(),
            'ctype': $('#ctype').val(),
            'bday': $('.bday').val(),
        };
        $.ajax({
            method: "POST",
            url: "/TestCode/update",
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
        var contact_id = $(this).closest('tr').find('td:eq(0)').text();
        //alert(contact_id);
        $('#delete_contact_id').val(contact_id);
        $('#modalFormDelete').modal('show');


    });
    $(document).on('click', '#delete_btnModal', function() {
        var contact_id = $('#delete_contact_id').val();
        $.ajax({
            method: "POST",
            url: "/TestCode/delete",
            data: {
                'contact_id': contact_id
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
                    <td class="contact_id">' + value['id'] + '</td>\
                    <td>' + value['name'] + '</td>\
                    <td>' + value['ctype'] + '</td>\
                    <td>' + value['phone'] + '</td>\
                    <td>' + value['bday'] + '</td>\
                    <td>\
                    <button type="button" class="btn btn-info" id="btn_edit">Edit</button>\
                    <button type="button" class="btn btn-danger" id="btn_delete">Delete</button>\
                    </td >\</tr> ');
            });
        }
    });
}


