var modal_comercio = null;
var comercio_form = null;
var dataTable = null;
$(function () {
    dataTable = initDataTableAjax($('#comercio_table'),
        {
            'processing': true,
            'serverSide': true,
            ajax: {
                url: $('#action_list').val(),
                data: function (filterDateTable) {
                    //additional params for ajax request
                    // filterDateTable.vendor_id = 3;
                },
            },
            'responsive': true,
            'language': {
                'paginate': {
                    'previous': '<i class="demo-psi-arrow-left"></i>',
                    'next': '<i class="demo-psi-arrow-right"></i>',
                },
            },
            columns: [
                {
                    data: 'name',
                    title: 'Nombre',
                },
                {
                    data: 'lat',
                    title: 'Latitud',
                },
                {
                    data: 'lng',
                    title: 'Logintud',
                },
                {
                    data: 'description',
                    title: 'Descripción',
                },
                
                {
                    data: 'status',
                    title: 'Estado',
                    render: function (data, type, row, meta) {
                        if (row.status === 'ACTIVE') {
                            return '<span class="label label-primary label-inline font-weight-lighter">Activo</span>';
                        } else {
                            return '<span class="label label-danger label-pill label-inline">Inactivo</span>';
                        }
                    },
                },
                {
                    data: null,
                    title: 'Acciones',
                    orderable: false,
                    render: function (data, type, row, meta) {
                       
                        return '<button class="btn btn-dark btn-sm" onclick="editComercio(' +
                            row.id + ')">Editar</button>';
                    },
                },
            ],
        });
    modal_comercio = $('#modal');
});

function editComercio(id) {
    modal_comercio.find('.modal-title').html('Editar punto de comercio');
    getForm($('#action_get_form').val() + '/' + id);
}

function newComercio() {
    modal_comercio.find('.modal-title').html('Crear punto de comercio');
    getForm($('#action_get_form').val());
}

function saveComercio() {
    if (comercio_form.valid()) {
        ajaxRequest($('#action_save').val(), {
            type: 'POST',
            data: comercio_form.serialize(),
            blockElement: '#modal .modal-content',//opcional: es para bloquear el elemento
            loading_message: 'Guardando...',
            error_message: 'Error al guardar la unidad de medida',
            success_message: 'La unidad de medida se guardo correctamente',
            success_callback: function (data) {
                modal_comercio.modal('hide');
                dataTable.ajax.reload();
            },
        });
    }
}

function getForm(action) {
    ajaxRequest(action, {
        type: 'GET',
        error_message: 'Error al cargar formulario',
        success_callback: function (data) {
            modal_comercio.find('.container_modal').html('');
            modal_comercio.find('.container_modal').html(data.html);
            comercio_form = $('#comercio_form');
            validateForm();            
            modal_comercio.modal({
                show: true,
                backdrop: 'static',
                keyboard: false, // to prevent closing with Esc button (if you want this too)
            });
        },
    });
}

function validateForm() {
    comercio_form.validate({
        rules: {
            name: {
                required: true,
                maxlength: 128
            },
            lat: {
                required: true,
                maxlength: 45
            },
            lng: {
                required: true,
                maxlength: 45
            },
            
        },
        messages: {
            
        },
        errorElement: 'small',
        errorClass: 'help-block',
        highlight: validationHighlight,
        success: validationSuccess,
        errorPlacement: validationErrorPlacement,
        submitHandler: function (form) {
            saveComercio();
        },
    });
}