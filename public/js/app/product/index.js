var modalProduct = null;
var imagesDeleted = [];
$(function () {
    loadProducts();
});

function loadProducts() {
    $.ajax({
        type: 'GET',
        url: $('#action_load_products').val(),
        success: function (data) {
            renderDataTable(data.data)
        }
    });
    modalProduct = $('#product_modal');
}

function renderDataTable(data) {
    let table=document.getElementById('product_table');
    let tbody = table.getElementsByTagName("tbody")[0];
    const tableData = data.map(function(product){
        return (
            `<tr id=${product.id} role="row">
               <td>${product.product ? product.product.name : ""}</td>
               <td>${product.stock ? product.stock : ""}</td>
               <td>${product.measure.measure ? product.measure.measure : ""}</td>
               <td>${product.price ? product.price : ""}</td>
               <td><button class="btn btn-dark btn-sm" onclick="editProduct(${product.id})">Editar</button> <button class="btn btn-danger btn-sm">Eliminar</button></td>
            </tr>`
        );
    }).join('');
    tbody.innerHTML=tableData;
    $('#product_table').tableDnD({
        sensitivity: 1,
        scrollAmount: 20,
        onDragClass: "table-success",
        onDrop: function(table, row) {
            var rows = table.tBodies[0].rows;
            let dataOrdered ={};
            for (var i=0; i<rows.length; i++) {
                dataOrdered[rows[i].id]=i+1;
            }
            $.ajax({
                type: 'PUT',
                url: $('#action_update_weight_product').val(),
                contentType: 'application/json',
                data: JSON.stringify(dataOrdered),
                success: function (data) {
                }
            });
        },
    });
}

function deletedCoverage(id) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Confirmación para eliminar cobertura",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
            
        }).then(function(result) {
            if (result.value) {   
                ajaxRequest($('#action_deleted_coverage').val() + '/' + id, {
                    type: 'DELETE',
                    success_callback: function(data) {
                        loadCoverages();
                    },
                  });
                  Swal.fire({
                    icon: "success",
                    title: "Eliminado correctamente",
                    showConfirmButton: false,
                    timer: 1500
                })

            }
        });
    
}

function editProduct(id) {
    modalProduct.find('.modal-title').html('Editar Producto');
    getformCoverage($('#action_get_form_product').val() + '/' + id);
}

function newProduct() {
    modalProduct.find('.modal-title').html('Crear Producto');
    getformCoverage($('#action_get_form_product').val());
}

function getformCoverage(url) {
    
    ajaxRequest(url, {
        type: 'GET',
        error_message: 'Error al cargar formulario',
        success_callback: function (data) {
            modalProduct.find('.container_modal').html('');
            modalProduct.find('.container_modal').html(data.html);
            formProduct = $("#product_form");
            validateformProduct();
             $('#measures_id').select2({
                dropdownParent: $('#product_form'),
                width: '100%',
                placeholder: '-Seleccione-',
            }); 
           
            modalProduct.modal({
                show: true,
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            });
        }
    });
}

function validateformProduct() {
    formProduct.validate({
        rules: {
            name: {
                required: true,
                maxlength: 64,
        },
        measure_id: {
            required: true,
            // remote: {
            //     url: $('#action_unique_coverage_type').val(),
            //     type: 'POST',
            //     data: {
            //         idPlan: function () {
            //             return $('#plan_id').val();
            //         },
            //         _token: $('meta[name="csrf-token"]').attr('content'),
            //         idTypeCoverage: function () {
            //             return $("#type_coverage_id").val().trim();
            //         },
            //
            //     }
            // }
        }
    },
        messages: {
            // type_coverage_id: {
            //     remote: 'Ya existe una cobertura de ese tipo.'
            // }
        },
        errorElement: 'small',
        errorClass: 'help-block',
        highlight: validationHighlight,
        success: validationSuccess,
        errorPlacement: validationErrorPlacement,
        submitHandler: function (form) {
            saveProduct();
        }
    });
    
}
function saveProduct() {
    if ($('#product_form').valid()) {
        var data = $('#product_form').serializeArray();
        ajaxRequest(
            $('#action_save_product').val(),
            {
                type: 'POST',
                data: data,
                blockElement: '#product_modal .modal-content',//opcional: es para bloquear el elemento
                loading_message: 'Guardando...',
                error_message: 'Error al guardar el producto',
                success_message: 'Se guardó correctamente',
                success_callback: function (data) {
                    $('#product_modal').modal('hide');
                    loadProducts();
                }
            });
    }
}
