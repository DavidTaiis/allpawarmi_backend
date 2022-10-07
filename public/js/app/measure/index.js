var modal_measure = null;
var measure_form = null;
var dataTable = null;
$(function () {
    dataTable = initDataTableAjax($('#measure_table'),
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
                    data: 'measure',
                    title: 'Unidad de medida',
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
                       
                        return '<button class="btn btn-dark btn-sm" onclick="editMeasure(' +
                            row.id + ')">Editar</button>';
                    },
                },
            ],
        });
    modal_measure = $('#modal');
});

function editMeasure(id) {
    modal_measure.find('.modal-title').html('Editar Medida');
    getForm($('#action_get_form').val() + '/' + id);
}

function newMeasure() {
    modal_measure.find('.modal-title').html('Crear Medida');
    getForm($('#action_get_form').val());
}

function saveMeasure() {
    if (measure_form.valid()) {
        ajaxRequest($('#action_save').val(), {
            type: 'POST',
            data: measure_form.serialize(),
            blockElement: '#modal .modal-content',//opcional: es para bloquear el elemento
            loading_message: 'Guardando...',
            error_message: 'Error al guardar la unidad de medida',
            success_message: 'La unidad de medida se guardo correctamente',
            success_callback: function (data) {
                modal_measure.modal('hide');
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
            modal_measure.find('.container_modal').html('');
            modal_measure.find('.container_modal').html(data.html);
            measure_form = $('#measure_form');
            validateForm();            
            modal_measure.modal({
                show: true,
                backdrop: 'static',
                keyboard: false, // to prevent closing with Esc button (if you want this too)
            });
        },
    });
}

function validateForm() {
    measure_form.validate({
        rules: {
            measure: {
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
            saveMeasure();
        },
    });
}