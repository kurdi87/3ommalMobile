var flag=true;
jQuery(document).ready(function() {
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": jQuery("#mydatatable").attr("data-link"),
        columnDefs: [
            {orderable: false, targets: 0},
            {orderable: false, targets: 1},
            {orderable: false, targets: 2},
        ],
        "columns": [
            {data: 'member', name: 'member'},
            {data: 'member', name: 'member'},
            {data: 'date', name: 'date'},
        ],
        "fnDrawCallback": function (oSettings) {
            oTable.column(0).nodes().each(function (cell, i) {
                cell.innerHTML = (parseInt(oTable.page.info().start)) + i + 1;
            });
        },
        "autoWidth": false,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
    });

    jQuery(window).resize(function() {
        oTable.columns().search('').draw();
    });
});