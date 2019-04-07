function submitSearch() {
    let data = {action: 'searchCars'};
    let id = $('#car_id').val();
    let mark = $('#car_mark').val();
    let an_producere = $('#car_an_producere').val();
    let volume = $('#car_volume').val();
    let parcurs = $('#car_parcurs').val();
    let tara = $('#car_tara').val();
    let pret = $('#car_pret').val();


    if (id) data = {...data, id};
    if (mark) data = {...data, mark};
    if (an_producere) data = {...data, an_producere};
    if (volume) data = {...data, volume};
    if (parcurs) data = {...data, parcurs};
    if (tara) data = {...data, tara};
    if (pret) data = {...data, pret};

    let post = id || mark || an_producere || volume || tara || parcurs || pret;
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
        data: {action: 'carsTable'},
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
            if ($(this).html() === 'Cars') $(this).addClass('active');
        });
    });

});

function composeTable() {
    let table = $('#carsTable');
    table.html(
        '<table class="table">' +
        '<thead class="thead-light">' +
        '<tr>' +
        '<th scope="col">Id</th>' +
        '<th scope="col">Marka</th>' +
        '<th scope="col">An producere</th>' +
        '<th scope="col">Volumul</th>' +
        '<th scope="col">Parcurs</th>' +
        '<th scope="col">Tara</th>' +
        '<th scope="col">Pret</th>' +
        '<th scope="col" style="min-width: 110px;">Actiuni</th>' +
        '</tr>' +
        '</thead>' +
        '<tr>' +
        '<th scope="row"><input class="form-control" id="car_id" name="car_id" /></th> ' +
        '<td><input class="form-control" id="car_mark" name="car_mark" /></td> ' +
        '<td><input class="form-control" id="car_an_producere" name="car_an_producere" /></td> ' +
        '<td><input class="form-control" id="car_volume" name="car_volume" /></td> ' +
        '<td><input class="form-control" id="car_parcurs" name="car_parcurs" /></td> ' +
        '<td><input class="form-control" id="car_tara" name="car_tara" /></td> ' +
        '<td><input class="form-control" id="car_pret" name="car_pret" /></td> ' +
        '<td>' +
        '<button type="button" onclick="clearForm()" class="btn btn-light"><i class="fa fa-trash"></i></button>' +
        '<button type="button" onclick="submitSearch()" class="btn btn-light"><i class="fa fa-search-location"></i></button>' +
        '</td>' +
        '</tr>' +
        '<tr>' +
        '<th scope="row"><h3><span class="badge badge-info">Creati masina noua </span></h3></th> ' +
        '<td><input class="form-control" id="car_mark_create" name="car_mark_create" /></td> ' +
        '<td><input class="form-control" id="car_an_producere_create" name="car_an_producere_create" /></td> ' +
        '<td><input class="form-control" id="car_volume_create" name="car_volume_create" /></td> ' +
        '<td><input class="form-control" id="car_parcurs_create" name="car_parcurs_create" /></td> ' +
        '<td><input class="form-control" id="car_tara_create" name="car_tara_create" /></td> ' +
        '<td><input class="form-control" id="car_pret_create" name="car_pret_create" /></td> ' +
        '<td>' +
        '<button type="button" onclick="clearCreate()" class="btn btn-light"><i class="fa fa-minus-circle   "></i></button>' +
        '<button type="button" onclick="createCar()" class="btn btn-light"><i class="fa fa-plus"></i></button>' +
        '</td>' +
        '</tr>' +
        '<tbody id="car-table-body">' +
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
        '        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateCar()">Save changes</button>' +
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
        result += '<tr id="car_' + item.id + '_row">' +
            '<th scope="row">' + (item.id || '') + '</th>' +
            '<td><span id="car_' + item.id + '_mark">' + (item.mark || '') + '</span></td>' +
            '<td><span id="car_' + item.id + '_an_producere">' + (item.anProducere || '') + '</span></td>' +
            '<td><span id="car_' + item.id + '_volume">' + (item.volume || '') + '</span></td>' +
            '<td><span id="car_' + item.id + '_parcurs">' + (item.parcurs || '') + '</span></td>' +
            '<td><span id="car_' + item.id + '_tara">' + (item.tara || '') + '</span></td>' +
            '<td><span id="car_' + item.id + '_pret">' + (item.pret || '') + '</span></td>' +
            '<td>' +
            '<button type="button" id="car_' + item.id + '_edit_button" onclick="editCar(' + item.id + ')" class="btn btn-light" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i></button>' +
            '<button type="button" onclick="deleteCar(' + item.id + ')" class="btn btn-light"><i class="fa fa-minus"></i></button>' +
            '</td>' +
            '</tr>';
    }
    $('#car-table-body').html(
        result
    );
}

function clearForm() {
    $('#car_id').val('');
    $('#car_mark').val('');
    $('#car_an_producere').val('');
    $('#car_volume').val('');
    $('#car_parcurs').val('');
    $('#car_tara').val('');
    $('#car_pret').val('');
    fillStandardTable();
}

function clearCreate() {
    $('#car_id_create').val('');
    $('#car_mark_create').val('');
    $('#car_an_producere_create').val('');
    $('#car_volume_create').val('');
    $('#car_parcurs_create').val('');
    $('#car_tara_create').val('');
    $('#car_pret_create').val('');
}

function createCar() {
    $('#car_name_create').removeClass('has-error');
    $('#car_email_create').removeClass('has-error');
    let data = {action: 'createCar'};
    let mark = $('#car_mark_create').val();
    let an_producere = $('#car_an_producere_create').val();
    let volume = $('#car_volume_create').val();
    let parcurs = $('#car_parcurs_create').val();
    let tara = $('#car_tara_create').val();
    let pret = $('#car_pret_create').val();

    if (mark) data = {...data, mark};
    if (an_producere) data = {...data, an_producere};
    if (volume) data = {...data, volume};
    if (parcurs) data = {...data, parcurs};
    if (tara) data = {...data, tara};
    if (pret) data = {...data, pret};

    $.ajax({
        url: 'post_center.php',
        method: "POST",
        data: data,
        success: function (data) {
            submitSearch();
            clearCreate();
        }
    });
}

function editCar(carId) {
    let mark = $('#car_' + carId + '_mark').html();
    let an_producere = $('#car_' + carId + '_an_producere').html();
    let volume = $('#car_' + carId + '_volume').html();
    let parcurs = $('#car_' + carId + '_parcurs').html();
    let tara = $('#car_' + carId + '_tara').html();
    let pret = $('#car_' + carId + '_pret').html();
    let data = {
        mark: mark,
        an_producere: an_producere,
        volume: volume,
        parcurs: parcurs,
        tara: tara,
        pret: pret
    };
    $('#exampleModalLabel').html("Edit car " + carId);
    $('#exampleModalSecretArea').html(carId);
    $('#exampleModalBody').html(
        '<form class="form car-form">' +
        '<h3 style="display:inline;"><label for="car_modal_mark" class="badge badge-light">Marka: </label>&nbsp;</h3>' +
        '<input type="text" id="car_modal_mark" value="' + mark + '" class="form-control float-right" />' +
        '<div class="clearfix"></div>' +
        '<h3 style="display:inline;"><label for="car_modal_an_producere" class="badge badge-light">An producere: </label>&nbsp;</h3>' +
        '<input type="text" id="car_modal_an_producere" value="' + an_producere + '" class="form-control float-right" />' +
        '<div class="clearfix"></div>' +
        '<h3 style="display:inline;"><label for="car_modal_volume" class="badge badge-light">Volumul: </label>&nbsp;</h3>' +
        '<input type="text" id="car_modal_volume" value="' + volume + '" class="form-control float-right" />' +
        '<div class="clearfix"></div>' +
        '<h3 style="display:inline;"><label for="car_modal_parcurs" class="badge badge-light">Parcurs: </label>&nbsp;</h3>' +
        '<input type="text" id="car_modal_parcurs" value="' + parcurs + '" class="form-control float-right" />' +
        '<div class="clearfix"></div>' +
        '<h3 style="display:inline;"><label for="car_modal_tara" class="badge badge-light">Tara: </label>&nbsp;</h3>' +
        '<input type="text" id="car_modal_tara" value="' + tara + '" class="form-control float-right" />' +
        '<div class="clearfix"></div>' +
        '<h3 style="display:inline;"><label for="car_modal_pret" class="badge badge-light">Pret: </label>&nbsp;</h3>' +
        '<input type="text" id="car_modal_pret" value="' + pret + '" class="form-control float-right" />' +
        '</form>'
    );
    console.log(data);
}

function updateCar() {
    let mark = $('#car_modal_mark').val();
    let an_producere = $('#car_modal_an_producere').val();
    let volume = $('#car_modal_volume').val();
    let parcurs = $('#car_modal_parcurs').val();
    let tara = $('#car_modal_tara').val();
    let pret = $('#car_modal_pret').val();
    let id = $('#exampleModalSecretArea').html();

    let data = {
        action: 'updateCar',
        id: id,
        mark: mark,
        an_producere: an_producere,
        volume: volume,
        parcurs: parcurs,
        tara: tara,
        pret: pret
    };

    $.ajax({
        url: 'post_center.php',
        method: "POST",
        data: data,
        success: function (data) {
            submitSearch();
        }
    });
}

function deleteCar(carId) {
    let data = {
        action: 'deleteCar',
        id: carId
    };
    $.ajax({
        url: 'post_center.php',
        method: "POST",
        data: data,
        success: function () {
            if (!$('#car_' + carId + '_row').hasClass('deleted')) {
                $('#car_' + carId + '_row').addClass('deleted');
                $('#car_' + carId + '_edit_button').attr('disabled', true);
                let i = 255;
                let interval = setInterval(function () {
                    $('#car_' + carId + '_row').css({background: 'rgb( 255,' + i + ',' + i-- + ')'});
                    if (i >= 255) window.clearInterval(interval);
                }, 7);
            }
        }
    });
}