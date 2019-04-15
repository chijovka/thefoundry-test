jQuery(document).ready(function() {

    var table_task_2_2 = $('#table_task_2_2').DataTable( {
        "stateSave": false,
        "processing": true,
        "serverSide": true,
        "sDom": "<'table-responsive' l r t><'row'<p i>>",
        "pagingType": "full_numbers",
        "destroy": true,
        "scrollCollapse": true,
        "ajax": {
            url: "/api/task_2_2",
            data: function (d) {
                d.type_processing = $('input[name=table_task_2_2_processing]:checked').val();
            }
        },
        "columns": [
            { type: "string", data: "dep_id", name: "dep_id", className: "text-center" },
            { type: "string", data: "dep_name", name: "dep_name", className: "text-center" },
            { type: "string", data: "rich_employee", name: "rich_employee", className: "text-center" },
            { type: "string", data: "max_salary", name: "max_salary", className: "text-center" },
            { type: "string", data: "sum_salary", name: "sum_salary", className: "text-center" }
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

    $('#table_task_2_2').data('datatable', table_task_2_2);

    $('input[name=table_task_2_2_processing]').on('change', function(e) {
        let table = $('#table_task_2_2').data('datatable');
        table.ajax.reload();
    });

});