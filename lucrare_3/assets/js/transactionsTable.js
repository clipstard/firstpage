function submitSearch() {
    let data = {action: 'searchTransactions'};
    let id = $('#transaction_id').val();
    let user_name = $('#transaction_user_name').val();
    let car_mark = $('#transaction_car_mark').val();
    let closed = $('#transaction_closed').val();


    if (id) data = {...data, id};
    if (user_name) data = {...data, user_name};
    if (car_mark) data = {...data, car_mark};
    if (closed) data = {...data, closed};


    let post = id || user_name || car_mark || closed;
    if (post) {
        $.ajax({
            url: "/api/transactions/",
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
        url: '/api/transactions/',
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
            if ($(this).html() === 'Transactions') $(this).addClass('active');
        });
    });
});

function getUsers() {
    $.ajax({
        url: '/api/users/',
        method: 'GET',
        headers: 'Content-type: application/json',
        success: function (data) {
            let result = '<option value=""></option>';
           for (let i =0; i< data.length; i++) {
               result += '<option value="' + data[i].id + '">' + data[i].name + ' (' + data[i].id + ')</option>'
           }
           $('#transaction_users').html(result);
        }
    });
}

function getCars() {
    $.ajax({
        url: '/api/cars/',
        method: 'GET',
        headers: 'Content-type: application/json',
        success: function (data) {
            let result = '<option value=""></option>';
            for (let i =0; i< data.length; i++) {
                result += '<option value="' + data[i].id + '">' + data[i].mark + ' (' + data[i].anProducere + ')</option>'
            }
            $('#transaction_cars').html(result);
        }
    });
}

function composeTable() {
    let date = new Date();
    let dateStr = '' + date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + ((date.getDate() < 10) ? ('0' + date.getDate()) : date.getDate());
    let table = $('#transactionsTable');
    table.html(
        '<table class="table">' +
        '<thead class="thead-light">' +
        '<tr>' +
        '<th scope="col">Id</th>' +
        '<th scope="col">User name</th>' +
        '<th scope="col">Car mark(year)</th>' +
        '<th scope="col">Data</th>' +
        '<th scope="col">Inchis(achitat)</th>' +
        '<th scope="col" style="min-width: 110px;">Actiuni</th>' +
        '</tr>' +
        '</thead>' +
        '<tr>' +
        '<th scope="row"><input class="form-control" id="transaction_id" name="transaction_id" /></th> ' +
        '<td><input class="form-control" id="transaction_user_name" name="transaction_user_name" /></td> ' +
        '<td><input class="form-control" id="transaction_car_mark" name="transaction_car_mark" /></td> ' +
        '<td><input class="form-control" id="transaction_data" name="transaction_data" /></td> ' +
        '<td>' +
        '<select class="form-control" id="transaction_closed">' +
        '<option value="">All</option>' +
        '<option value="0">False</option>' +
        '<option value="1">True</option>' +
        '</select>' +
        '</td> ' +
        '<td>' +
        '<button type="button" onclick="clearForm()" class="btn btn-light"><i class="fa fa-trash"></i></button>' +
        '<button type="button" onclick="submitSearch()" class="btn btn-light"><i class="fa fa-search-location"></i></button>' +
        '</td>' +
        '</tr>' +
        '<tr>' +
        '<th scope="row"><h3><span class="badge badge-info">Inregistrati o tranzactie </span></h3></th> ' +
        '<td><select id="transaction_users" class="form-control"></select></td> ' +
        '<td><select id="transaction_cars" class="form-control"></select></td> ' +
        '<td><input class="form-control" id="transaction_data_create" name="transaction_data_create" value="' + dateStr + '" readonly /></td> ' +
        '<td>' +
        '<div class="checkboxOverride">' +
        '<h3 class="checkboxH3">Closed </h3>' +
        '<input type="checkbox" id="transaction_closed_create" class="form-control checkbox" />' +
        '<label for="transaction_closed_create" class="badge badge-light"> </label>&nbsp;' +
        '</div>' +
        '</td> ' +
        '<td>' +
        '<button type="button" onclick="clearCreate()" class="btn btn-light"><i class="fa fa-minus-circle   "></i></button>' +
        '<button type="button" onclick="createTransaction()" class="btn btn-light"><i class="fa fa-plus"></i></button>' +
        '</td>' +
        '</tr>' +
        '<tbody id="transaction-table-body">' +
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
        '        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateTransaction()">Save changes</button>' +
        '      </div>' +
        '    </div>' +
        '  </div>' +
        '</div>'
    );
    getCars();
    getUsers();
}

function composeRows(data) {
    let result = '';
    if (!data) return result;
    for (let item of data) {
        result += '<tr id="transaction_' + item.id + '_row">' +
            '<th scope="row">' + (item.id || '') + '</th>' +
            '<td><span id="transaction_' + item.id + '_user">' + (item.user.name || '') + ' (' + (item.user.id || '') + ')</span></td>' +
            '<td><span id="transaction_' + item.id + '_car">' + (item.car.mark || '') + ' (' + (item.car.anProducere || 'mystery') + ')</span></td>' +
            '<td><span id="transaction_' + item.id + '_data">' + (item.data || '') + '</span></td>' +
            '<td><span id="transaction_' + item.id + '_closed">' + (((item.closed === '0') ? 'false' : 'true') || '') + '</span></td>' +
            '<td>' +
            '<button type="button" id="transaction_' + item.id + '_edit_button" onclick="editTransaction(' + item.id + ')" class="btn btn-light" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i></button>' +
            '<button type="button" onclick="deleteTransaction(' + item.id + ')" class="btn btn-light"><i class="fa fa-minus"></i></button>' +
            '</td>' +
            '</tr>';
    }
    $('#transaction-table-body').html(result);
}

function clearForm() {
    $('#transaction_id').val('');
    $('#transaction_car_mark').val('');
    $('#transaction_user_name').val('');
    $('#transaction_data').val('');
    $('#transaction_closed').val('');
    fillStandardTable();
}

function clearCreate() {
    $('#transaction_cars').val('');
    $('#transaction_users').val('');
    $('#transaction_closed_create').prop('checked', false);
}

function createTransaction() {
    let data = {};
    let userId = $('#transaction_users').val();
    let carId = $('#transaction_cars').val();
    let closed = ($('#transaction_closed_create').is(':checked')) ? '1' : '0';

    if (!userId || !carId) return;
    data = {...data, user_id: userId, car_id: carId};
    if(closed) data = {...data, closed: closed};
    $.ajax({
        url: '/api/transactions/',
        method: 'POST',
        data: data,
        success: function (data) {
            submitSearch();
            clearCreate();
        }
    });
}

function editTransaction(transactionId) {
    $('#exampleModalLabel').html("Close transaction " + transactionId);
    $('#exampleModalSecretArea').html(transactionId);
    let closed = $('#transaction_' + transactionId + '_closed').html();
    $('#exampleModalBody').html(
        '<form class="form transaction-form">' +

        '<div class="checkboxOverride">' +
        '<h3 class="checkboxH3">Close transaction </h3>' +
        '<input type="checkbox" id="transaction_modal_closed" class="form-control checkbox" ' +((closed === 'true') ? 'checked' : '') +'/>' +
        '<label for="transaction_modal_closed" class="badge badge-light"> </label>&nbsp;' +
        '</div>' +
        '</form>'
    );
}

function updateTransaction() {
    let closed = ($('#transaction_modal_closed').is(':checked') ? '1' : '0');
    let id = $('#exampleModalSecretArea').html();

    if (!id) return;
    let data = {
        closed: closed
    };

    $.ajax({
        url: '/api/transactions/' + id,
        method: 'PUT',
        data: data,
        success: function (data) {
            submitSearch();
        }
    });
}

function deleteTransaction(transactionId) {
    if (!transactionId) return;
    $.ajax({
        url: '/api/transactions/' + transactionId,
        method: 'DELETE',
        success: function () {
            if (!$('#transaction_' + transactionId + '_row').hasClass('deleted')) {
                $('#transaction_' + transactionId + '_row').addClass('deleted');
                $('#transaction_' + transactionId + '_edit_button').attr('disabled', true);
                let i = 255;
                let interval = setInterval(function () {
                    $('#transaction_' + transactionId + '_row').css({background: 'rgb( 255,' + i + ',' + i-- + ')'});
                    if (i >= 255) window.clearInterval(interval);
                }, 7);
            }
        }
    });
}