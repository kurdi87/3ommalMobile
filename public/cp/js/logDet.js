var users = function () {

    var handleBtnClear = function () {
        jQuery(document).on('click', '.cleardate', function () {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            input_wlbl();
            oTable.columns(7).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
            return false;
        });
    };

    var handleInputDate = function () {
        jQuery(document).on('change', '.inputdateclear', function () {
            if (jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val()) {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').removeClass('display-none');
            }
            else {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            }
        });
    };

    return {
        init: function () {
            handleBtnClear();
            handleInputDate();
        }
    };

}();

jQuery(document).ready(function () {
    users.init();
    var flag = true;
    var my_id=jQuery("#mydatatable").attr("data-id");
    var url="cp-attar/log/details/list/"+my_id;

    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": url,
        columnDefs: [
            {orderable: false, targets: 0}
        ],
        "columns": [
            {data: 'LogDet_ID', name: 'LogDet_ID'},
            {data: 'LogPK_FieldName', name: 'LogPK_FieldName'},
            {data: 'LogDet_ReferencedTableName', name: 'LogDet_ReferencedTableName'},
            {data: 'LogDet_ReferencedFieldName', name: 'LogDet_ReferencedFieldName'},
            {data: 'LogDet_OldValue', name: 'LogDet_OldValue'},
            {data: 'LogDet_NewValue', name: 'LogDet_NewValue'}
        ],
        "fnDrawCallback": function (oSettings) {
            mytooltipster();
            oTable.column(0).nodes().each(function (cell, i) {
                cell.innerHTML = (parseInt(oTable.page.info().start)) + i + 1;
            });
            $('.popovers').popover();
            App.init();
        },
        // setup responsive extension: http://datatables.net/extensions/responsive/
        //responsive: true,
        "autoWidth": false,
        "scrollX": true,
        "pagingType": "bootstrap_full_number",
        "iDisplayLength": 50
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable.draw();
    });

    jQuery(window).resize(function() {
        oTable.columns().search('').draw();
    });
    
    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
    });
    
    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            oTable.columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        oTable.columns(column).search($(this).val()).draw();
    });

    $('#from, #to').change(function () {
        oTable.columns(4).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
    });

    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable.columns().search('').draw();
    });
});