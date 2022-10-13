var modalStop = null;
var imagesDeleted = [];
$(function () {
    loadStops();
});

function loadStops() {
    $.ajax({
        type: 'GET',
        url: $('#action_load_stops').val(),
        success: function (data) {
            renderDataTable(data.data)
        }
    });
    modalStop = $('#stop_modal');
}

function renderDataTable(data) {
    let table=document.getElementById('stop_table');
    let tbody = table.getElementsByTagName("tbody")[0];
    const tableData = data.map(function(stop){
        return (
            `<tr id=${stop.id} role="row">
               <td>${stop ? stop.name : ""}</td>
               <td>${stop ? stop.description : ""}</td>
               <td>${stop ? stop.status : ""}</td>
               <td><button class="btn btn-dark btn-sm" onclick="editStop(${stop.id})">Editar</button></td>
            </tr>`
        );
    }).join('');
    tbody.innerHTML=tableData;
    $('#stop_table').tableDnD({
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
                url: $('#action_update_weight_stop').val(),
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

function editStop(id) {
    modalStop.find('.modal-title').html('Editar Stopo');
    getformStop($('#action_get_form_stop').val() + '/' + id);
}

function newStop() {
    modalStop.find('.modal-title').html('Crear Stopo');
    getformStop($('#action_get_form_stop').val());
}

function getformStop(url) {
    
    ajaxRequest(url, {
        type: 'GET',
        error_message: 'Error al cargar formulario',
        success_callback: function (data) {
            modalStop.find('.container_modal').html('');
            modalStop.find('.container_modal').html(data.html);
            formStop = $("#stop_form");
            validateformStop();
             $('#measures_id').select2({
                dropdownParent: $('#stop_form'),
                width: '100%',
                placeholder: '-Seleccione-',
            }); 
           
            modalStop.modal({
                show: true,
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            });
        }
    });
}

function validateformStop() {
    formStop.validate({
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
            saveStop();
        }
    });
    
}
function saveStop() {
    if ($('#stop_form').valid()) {
        var data = $('#stop_form').serializeArray();
        ajaxRequest(
            $('#action_save_stop').val(),
            {
                type: 'POST',
                data: data,
                blockElement: '#stop_modal .modal-content',//opcional: es para bloquear el elemento
                loading_message: 'Guardando...',
                error_message: 'Error al guardar el stopo',
                success_message: 'Se guardó correctamente',
                success_callback: function (data) {
                    $('#stop_modal').modal('hide');
                    loadStops();
                }
            });
    }
}
