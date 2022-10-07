var modal_association = null;
var form_user = null;
var dataTable = null;
$(function () {
    dataTable = initDataTableAjax($('#association_table'),
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
                    data: 'advantages',
                    title: 'Ventajas',
                },
                {
                    data: 'rules',
                    title: 'Reglas',
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
                       
                        return '<button class="btn btn-dark btn-sm" onclick="editAssociation(' +
                            row.id + ')">Editar</button>';
                    },
                },
            ],
        });
    modal_association = $('#modal');
});

function editAssociation(id) {
    modal_association.find('.modal-title').html('Editar Asociación');
    getForm($('#action_get_form').val() + '/' + id);
}

function newAssociation() {
    modal_association.find('.modal-title').html('Crear Asociación');
    getForm($('#action_get_form').val());
}

function saveAssociation() {
    if (form_user.valid()) {
        ajaxRequest($('#action_save').val(), {
            type: 'POST',
            data: form_user.serialize(),
            blockElement: '#modal .modal-content',//opcional: es para bloquear el elemento
            loading_message: 'Guardando...',
            error_message: 'Error al guardar el usuario',
            success_message: 'La asociación se guardo correctamente',
            success_callback: function (data) {
                modal_association.modal('hide');
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
            modal_association.find('.container_modal').html('');
            modal_association.find('.container_modal').html(data.html);
            form_user = $('#association_form');
            validateForm();
            $('#users_id').select2({
                dropdownParent: $('#modal'),
                width: '100%',
                placeholder: '-Seleccione-',
            });
            
            modal_association.modal({
                show: true,
                backdrop: 'static',
                keyboard: false, // to prevent closing with Esc button (if you want this too)
            });
        },
    });
}

function validateForm() {
    form_user.validate({
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
            saveAssociation();
        },
    });
}