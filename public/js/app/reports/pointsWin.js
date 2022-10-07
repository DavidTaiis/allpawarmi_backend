var modalModel = null;
var formModel = null;
var dataTable = null;

$(function () {
    dataTable = initDataTableAjax($('#model_table'),
        {
            "processing": true,
            "serverSide": true,
            "searching": false,
            ajax: {
                url: $('#action_load_models').val(),
                data: function (filterDateTable) {
                    filterDateTable.dateStart = $('#dateStart').val();
                    filterDateTable.dateEnd = $('#dateEnd').val();
                    filterDateTable.campaignId = $('#campaignId').val();
                    filterDateTable.objectiveId = $('#objectiveId').val();
                    filterDateTable.userId = $('#userId').val();
                }
            },
            "responsive": true,
            "language": {
                "paginate": {
                    "previous": '<i class="demo-psi-arrow-left"></i>',
                    "next": '<i class="demo-psi-arrow-right"></i>'
                }
            },
            columns: [
                {
                    data: "id",
                    title: '#',
                    render: function (data, type, row, meta) {
                        return row.id;
                    }
                },
                {
                    data: 'userName',
                    title: 'Usuario'
                },
                {
                    data: 'userEmail',
                    title: 'Email'
                },
                {
                    data: 'points_win',
                    title: 'Puntos'
                },
                {
                    data: 'campaignName',
                    title: 'Misión'
                },
                {
                    data: 'missionName',
                    title: 'Objetivo'
                },
                {
                    data: "created_at",
                    title: 'Fecha',
                    render: function (data, type, row, meta) {
                        return moment(row.created_at).format('YYYY/MM/DD HH:mm:ss');
                    }
                }
            ]
        });

    $('#userId').select2({
        width: '100%',
        placeholder: '-Seleccione-',
        allowClear: true
    });
    $('#campaignId').select2({
        width: '100%',
        placeholder: '-Seleccione-',
        allowClear: true
    });
    $('#objectiveId').select2({
        width: '100%',
        placeholder: '-Seleccione-',
        allowClear: true,
        data: objectives
    });
    $('#campaignId').on('change', function () {
        if ($(this).val()) {
            let selectedCampaignId = $(this).val();
            console.log(selectedCampaignId);
            let filterObjectives = objectives.filter(function (item) {
                return selectedCampaignId.indexOf(item.campaignId+'')>-1;
            });
            $("#objectiveId").select2('destroy').empty().select2({
                width: '100%',
                placeholder: '-Seleccione-',
                allowClear: true, data: filterObjectives
            });
            $("#objectiveId").val(null).trigger('change');
            dataTable.ajax.reload();
            $('#objectiveId').on('change', function () {
                dataTable.ajax.reload();
            });
        }

    });
    $("#dateStart").on('change', function () {
        dataTable.ajax.reload();
    });
    $('#userId').on('change', function () {
        dataTable.ajax.reload();
    });
    $('#objectiveId').on('change', function () {
        dataTable.ajax.reload();
    });
    $("#dateEnd").on('change', function () {
        dataTable.ajax.reload();
    });
    /*  $("#trackingStatus").on('change', function () {
          dataTable.ajax.reload();
      });
      $("#status").on('change', function () {
          dataTable.ajax.reload();
      });
     */

});


function exportPointsWin() {
    showAlert('info', 'Se está exportando...');
    $('#form_export').attr('action', $('#action_export').val());
    $("#query_search").val($("input[type='search']").val());
    $('#form_export').submit();

}
