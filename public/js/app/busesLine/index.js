var modal_busesLine = null;
var form_busesLine = null;
var dataTable = null;
$(function () {
    dataTable = initDataTableAjax($('#busesLine_table'),
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
                    data: 'price',
                    title: 'Precio',
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
                       
                        return '<button class="btn btn-dark btn-sm" onclick="editbusesLine(' +
                            row.id + ')">Editar</button> <a href="'+ $('#action_index_stops').val() +'/'+ row.id+'" target=""><span class="btn btn-dark btn-sm">Paradas</span></a>';
                    },
                },
            ],
        });
    modal_busesLine = $('#modal');
});

function editbusesLine(id) {
    modal_busesLine.find('.modal-title').html('Editar Linea de Bus');
    getForm($('#action_get_form').val() + '/' + id);
}

function newbusesLine() {
    modal_busesLine.find('.modal-title').html('Crear Linea de Bus');
    getForm($('#action_get_form').val());
}

function savebusesLine() {
    if (form_busesLine.valid()) {
        ajaxRequest($('#action_save').val(), {
            type: 'POST',
            data: form_busesLine.serialize(),
            blockElement: '#modal .modal-content',//opcional: es para bloquear el elemento
            loading_message: 'Guardando...',
            error_message: 'Error al guardar el Linea de Bus',
            success_message: 'La Linea de Bus se guardo correctamente',
            success_callback: function (data) {
                modal_busesLine.modal('hide');
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
            modal_busesLine.find('.container_modal').html('');
            modal_busesLine.find('.container_modal').html(data.html);
            form_busesLine = $('#busesLine_form');
            validateForm();
            $('#busesLines_id').select2({
                dropdownParent: $('#modal'),
                width: '100%',
                placeholder: '-Seleccione-',
            });
            
            modal_busesLine.modal({
                show: true,
                backdrop: 'static',
                keyboard: false, // to prevent closing with Esc button (if you want this too)
            });
        },
    });
}

function validateForm() {
    form_busesLine.validate({
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
            savebusesLine();
        },
    });
}