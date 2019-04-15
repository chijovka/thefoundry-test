jQuery(document).ready(function() {

    var table_task_3_1 = $('#table_task_3_1').DataTable( {
        "stateSave": false,
        "processing": true,
        "serverSide": true,
        "sDom": "<'table-responsive' l r t><'row'<p i>>",
        "pagingType": "full_numbers",
        "destroy": true,
        "scrollCollapse": true,
        "ajax": {
            url: "/api/task_3_1",
            data: function (d) {
                d.type_processing = $('input[name=table_task_3_1_processing]:checked').val();
            }
        },
        "columns": [
            {
                type: "string",
                sType: "numeric",
                data: "median",
                name: "median",
                render: $.fn.dataTable.render.number(' ', '.', 2, '',''),
                className: "text-center"
            }
        ],
        "order": [[ 0, "asc" ]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
        },
        "fixedHeader": {
            header: true,
            headerOffset: $('.page-container > .header').height()
        }
    });

    $('#table_task_3_1').data('datatable', table_task_3_1);

    $('input[name=table_task_3_1_processing]').on('change', function(e) {
        let table = $('#table_task_3_1').data('datatable');
        table.ajax.reload();
    });

});