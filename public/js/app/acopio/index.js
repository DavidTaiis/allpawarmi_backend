var modal_acopio = null;
var acopio_form = null;
var dataTable = null;
$(function () {
    dataTable = initDataTableAjax($('#acopio_table'),
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
                    title: 'Longitud',
                },
                {
                    data: 'days',
                    title: 'Días',
                },
                {
                    data: 'hours',
                    title: 'Horas',
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
                       
                        return '<button class="btn btn-dark btn-sm" onclick="editAcopio(' +
                            row.id + ')">Editar</button>';
                    },
                },
            ],
        });
    modal_acopio = $('#modal');
});

function editAcopio(id) {
    modal_acopio.find('.modal-title').html('Editar Acopio');
    getForm($('#action_get_form').val() + '/' + id);
}

function newAcopio() {
    modal_acopio.find('.modal-title').html('Crear Acopio');
    getForm($('#action_get_form').val());
}

function saveAcopio() {
    if (acopio_form.valid()) {
        ajaxRequest($('#action_save').val(), {
            type: 'POST',
            data: acopio_form.serialize(),
            blockElement: '#modal .modal-content',//opcional: es para bloquear el elemento
            loading_message: 'Guardando...',
            error_message: 'Error al guardar el usuario',
            success_message: 'El centro de acopio se guardo correctamente',
            success_callback: function (data) {
                modal_acopio.modal('hide');
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
            modal_acopio.find('.container_modal').html('');
            modal_acopio.find('.container_modal').html(data.html);
            acopio_form = $('#acopio_form');
            validateForm();
            $('#users_id').select2({
                dropdownParent: $('#modal'),
                width: '100%',
                placeholder: '-Seleccione-',
            });
            $('#days').select2({
                dropdownParent: $('#modal'),
                width: '100%',
                placeholder: '-Seleccione-',
                multiple: true
            });
            
            modal_acopio.modal({
                show: true,
                backdrop: 'static',
                keyboard: false, // to prevent closing with Esc button (if you want this too)
            });
        },
    });
}

function validateForm() {
    acopio_form.validate({
        rules: {
            name: {
                required: true,
                maxlength: 64
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
            saveAcopio();
        },
    });
}