var modal_news = null;
var news_form = null;
var dataTable = null;
$(function () {
    dataTable = initDataTableAjax($('#news_table'),
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
                    data: 'title',
                    title: 'Titulo',
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
                    data: 'description',
                    title: 'Descripción',
                },
                {
                    data: 'date',
                    title: 'Fecha',
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
                       
                        return '<button class="btn btn-dark btn-sm" onclick="editNews(' +
                            row.id + ')">Editar</button>';
                    },
                },
            ],
        });
    modal_news = $('#modal');
});

function editNews(id) {
    modal_news.find('.modal-title').html('Editar Noticia');
    getForm($('#action_get_form').val() + '/' + id);
}

function newNews() {
    modal_news.find('.modal-title').html('Crear Noticia');
    getForm($('#action_get_form').val());
}

function saveNews() {
    if (news_form.valid()) {
        ajaxRequest($('#action_save').val(), {
            type: 'POST',
            data: news_form.serialize(),
            blockElement: '#modal .modal-content',//opcional: es para bloquear el elemento
            loading_message: 'Guardando...',
            error_message: 'Error al guardar la noticia',
            success_message: 'La noticia se guardó correctamente',
            success_callback: function (data) {
                modal_news.modal('hide');
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
            modal_news.find('.container_modal').html('');
            modal_news.find('.container_modal').html(data.html);
            news_form = $('#news_form');    
            validateForm();      
            modal_news.modal({
                show: true,
                backdrop: 'static',
                keyboard: false, // to prevent closing with Esc button (if you want this too)
            });
        },
    });
}

function validateForm() {
    news_form.validate({
        rules: {
            title: {
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
            saveNews();
        },
    });
}