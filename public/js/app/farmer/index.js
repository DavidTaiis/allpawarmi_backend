
var dataTable = null;
$(function () {
    dataTable = initDataTableAjax($('#farmer_table'),
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
                    data: 'identification_card',
                    title: 'Identificación',
                },
                {
                    data: 'phone_number',
                    title: 'Telefóno',
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
                        if (row.id === 1) {
                            return '';
                        } 
                        return '<a href="'+ $('#action_index_product').val() +'/'+ row.id+'" target=""><span class="btn btn-dark btn-sm">Productos</span></a> ';
                    },
                },
            ],
        });
   
});


