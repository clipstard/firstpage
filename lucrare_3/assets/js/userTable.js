function submitSearch() {
    let data = {action: 'usersSearch'};
    let id = $('#user_id').val();
    let name = $('#user_name').val();
    let email = $('#user_email').val();
    let firma = $('#user_firma').val();
    let tara = $('#user_tara').val();

    if (id) data = {...data, id};
    if (name) data = {...data, name};
    if (email) data = {...data, email};
    if (firma) data = {...data, firma};
    if (tara) data = {...data, tara};

    let post = id || name || email || firma || tara;
    if (post) {
        $.ajax({
            url: "post_center.php",
            data: data,
            method: "POST",
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
        url: 'get_center.php',
        method: 'GET',
        headers: 'Content-type: application/json',
        data: {action: 'usersTable'},
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
        '</td> ' +
        '</tr>' +
        '<tbody id="user-table-body">' +
        '</tbody>' +
        '</table>'
    );
}

function composeRows(data) {
    let result = '';
    if (!data) return result;
    for (let item of data) {
        result += '<tr>' +
            '<th scope="row">' + (item.id || '') + '</th>' +
            '<td>' + (item.name || '') + '</td>' +
            '<td>' + (item.email || '') + '</td>' +
            '<td>' + (item.firm || '') + '</td>' +
            '<td>' + (item.tara || '') + '</td>' +
            '<td>' + '' + '</td>' +
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
    $('#user_firma').val('');
    $('#user_tara').val('');
    fillStandardTable();
}