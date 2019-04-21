function submitSearch() {
    let data = {action: 'searchUsers'};
    let id = $('#user_id').val();
    let name = $('#user_name').val();
    let email = $('#user_email').val();
    let firma = $('#user_firm').val();
    let tara = $('#user_tara').val();

    if (id) data = {...data, id};
    if (name) data = {...data, name};
    if (email) data = {...data, email};
    if (firma) data = {...data, firma};
    if (tara) data = {...data, tara};

    let post = id || name || email || firma || tara;
    let url = (id) ? "/api/users/" + id : "/api/users/";
    if (post) {
        $.ajax({
            url: url,
            data: data,
            method: "GET",
            success: function (data) {
                composeRows(data);
            }
        });
    } else {
        fillStandardTable();
    }
}

function fillStandardTable() {
    $.ajax({
        url: '/api/users/',
        method: 'GET',
        headers: 'Content-type: application/json',
        success: function (data) {
            composeRows(data);
        }
    });
}

$(document).ready(function () {
    composeTable();
    fillStandardTable();
    $('.nav-item').each(function () {
        $(this).removeClass('active');
        $(this).children().each(function () {
            if ($(this).html() === 'Users') $(this).addClass('active');
        });
    });

});

function composeTable() {
    let table = $('#usersTable');
    table.html(
        '<table class="table">' +
        '<thead class="thead-light">' +
        '<tr>' +
        '<th scope="col">Id</th>' +
        '<th scope="col">Nume</th>' +
        '<th scope="col">Email</th>' +
        '<th scope="col">Firma</th>' +
        '<th scope="col">Tara</th>' +
        '<th scope="col">Actiuni</th>' +
        '</tr>' +
        '</thead>' +
        '<tr>' +
        '<th scope="row"><input class="form-control" id="user_id" name="user_id" /></th> ' +
        '<td><input class="form-control" id="user_name" name="user_name" /></td> ' +
        '<td><input class="form-control" id="user_email" name="user_email" /></td> ' +
        '<td><input class="form-control" id="user_firm" name="user_firm" /></td> ' +
        '<td><input class="form-control" id="user_tara" name="user_tara" /></td> ' +
        '<td>' +
        '<button type="button" onclick="clearForm()" class="btn btn-light"><i class="fa fa-trash"></i></button>' +
        '<button type="button" onclick="submitSearch()" class="btn btn-light"><i class="fa fa-search-location"></i></button>' +
        '</td>' +
        '</tr>' +
        '<tr>' +
        '<th scope="row"><h3><span class="badge badge-info">Creati user nou </span></h3></th> ' +
        '<td><input class="form-control" id="user_name_create" name="user_name_create" /></td> ' +
        '<td><input class="form-control" id="user_email_create" name="user_email_create" /></td> ' +
        '<td><input class="form-control" id="user_firm_create" name="user_firm_create" /></td> ' +
        '<td><input class="form-control" id="user_tara_create" name="user_tara_create" /></td> ' +
        '<td>' +
        '<button type="button" onclick="clearCreate()" class="btn btn-light"><i class="fa fa-minus-circle   "></i></button>' +
        '<button type="button" onclick="createUser()" class="btn btn-light"><i class="fa fa-plus"></i></button>' +
        '</td>' +
        '</tr>' +
        '<tbody id="user-table-body">' +
        '</tbody>' +
        '</table>' +
        '<!-- Modal -->' +
        '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
        '  <div class="modal-dialog" role="document">' +
        '    <div class="modal-content">' +
        '      <div class="modal-header">' +
        '        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>' +
        '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
        '          <span aria-hidden="true">&times;</span>' +
        '        </button>' +
        '      </div>' +
        '          <span aria-hidden="true" hidden="true" id="exampleModalSecretArea"></span>' +
        '      <div class="modal-body" id="exampleModalBody">' +
        '        ...' +
        '      </div>' +
        '      <div class="modal-footer">' +
        '        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' +
        '        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateUser()">Save changes</button>' +
        '      </div>' +
        '    </div>' +
        '  </div>' +
        '</div>'
    );
}

function composeRows(data) {
    let result = '';
    if (!data) return result;
    for (let item of data) {
        result += '<tr id="user_' + item.id + '_row">' +
            '<th scope="row">' + (item.id || '') + '</th>' +
            '<td><span id="user_' + item.id + '_name">' + (item.name || '') + '</span></td>' +
            '<td><span id="user_' + item.id + '_email">' + (item.email || '') + '</span></td>' +
            '<td><span id="user_' + item.id + '_firm">' + (item.firm || '') + '</span></td>' +
            '<td><span id="user_' + item.id + '_tara">' + (item.tara || '') + '</span></td>' +
            '<td>' +
            '<button type="button" id="user_' + item.id + '_edit_button" onclick="editUser(' + item.id + ')" class="btn btn-light" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user-edit"></i></button>' +
            '<button type="button" onclick="deleteUser(' + item.id + ')" class="btn btn-light"><i class="fa fa-user-minus"></i></button>' +
            '</td>' +
            '</tr>';
    }
    $('#user-table-body').html(
        result
    );
}

function clearForm() {
    $('#user_id').val('');
    $('#user_name').val('');
    $('#user_email').val('');
    $('#user_firm').val('');
    $('#user_tara').val('');
    fillStandardTable();
}

function clearCreate() {
    $('#user_id_create').val('');
    $('#user_name_create').val('');
    $('#user_email_create').val('');
    $('#user_firm_create').val('');
    $('#user_tara_create').val('');
}

function createUser() {
    $('#user_name_create').removeClass('has-error');
    $('#user_email_create').removeClass('has-error');
    let data = {action: 'createUser'};
    let name = $('#user_name_create').val();
    let email = $('#user_email_create').val();
    let firma = $('#user_firm_create').val();
    let tara = $('#user_tara_create').val();

    if (!name || !email) {
        if (!name) $('#user_name_create').addClass('has-error');
        if (!email) $('#user_email_create').addClass('has-error');
        return;
    }
    data = {...data, name, email};
    if (firma) data = {...data, firma};
    if (tara) data = {...data, tara};
    $.ajax({
        url: '/api/users/',
        method: "POST",
        data: data,
        success: function (data) {
            submitSearch();
            clearCreate();
        }
    });
}

function editUser(userId) {
    let name = $('#user_' + userId + '_name').html();
    let email = $('#user_' + userId + '_email').html();
    let firma = $('#user_' + userId + '_firm').html();
    let tara = $('#user_' + userId + '_tara').html();
    let data = {
        name: name,
        email: email,
        firma: firma,
        tara: tara
    };
    $('#exampleModalLabel').html("Edit user " + userId);
    $('#exampleModalSecretArea').html(userId);
    $('#exampleModalBody').html(
        '<form class="form">' +
        '<h3 style="display:inline;"><label for="user_modal_name" class="badge badge-light">Name: </label>&nbsp;</h3>' +
        '<input type="text" id="user_modal_name" value="' + name + '" class="form-control float-right" />' +
        '<h3 style="display:inline;"><label for="user_modal_email" class="badge badge-light">Email: </label>&nbsp;</h3>' +
        '<input type="text" id="user_modal_email" value="' + email + '" class="form-control float-right" />' +
        '<h3 style="display:inline;"><label for="user_modal_firm" class="badge badge-light">Firma: </label>&nbsp;</h3>' +
        '<input type="text" id="user_modal_firm" value="' + firma + '" class="form-control float-right" />' +
        '<h3 style="display:inline;"><label for="user_modal_tara" class="badge badge-light">Tara: </label>&nbsp;</h3>' +
        '<input type="text" id="user_modal_tara" value="' + tara + '" class="form-control float-right" />' +
        '</form>'
    );
    console.log(data);
}

function updateUser() {
    let name = $('#user_modal_name').val();
    let email = $('#user_modal_email').val();
    let firma = $('#user_modal_firm').val();
    let tara = $('#user_modal_tara').val();
    let id = $('#exampleModalSecretArea').html();

    let data = {
        name: name,
        email: email,
        firma: firma,
        tara: tara
    };

    if (!id) return;
    $.ajax({
        url: '/api/users/' + id,
        method: "PUT",
        data: data,
        success: function (data) {
            submitSearch();
        }
    });
}

function deleteUser(userId) {
    let data = {
        action: 'deleteUser',
        id: userId
    };
    $.ajax({
       url: '/api/users/' + userId,
       method: "DELETE",
       data: data,
       success: function() {
           if (!$('#user_' + userId + '_row').hasClass('deleted')) {
               $('#user_' + userId + '_row').addClass('deleted');
               $('#user_' + userId + '_edit_button').attr('disabled', true);
               let i = 255;
               let interval = setInterval(function () {
                   $('#user_' + userId + '_row').css({background: 'rgb( 255,' + i + ',' + i-- + ')'});
                   if (i >= 255) window.clearInterval(interval);
               }, 7);
           }
       }
    });
}