var flag = true;
var inquires = function () {

    var handleBtnClear = function () {
        jQuery(document).on('click', '.cleardate', function () {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            oTable.columns(6).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
            input_wlbl();
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
    inquires.init();

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable.draw();
    });
    
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "cp-attar/inquiry/list",
        "order": [[3, 'desc'],[6, 'desc']],
        columnDefs: [
            {orderable: false, targets: 0},
            {searchable: false, targets: 0},
            {searchable: false, targets: 3},
            {searchable: false, targets: -1},
        ],
        "columns": [
            {data: 'Inq_ID', name: 'Inq_ID'},
            {data: 'Inq_Message', name: 'Inq_Message'},
            {data: 'type', name: 'Inq_Type'},
            {data: 'InqRes_ID', name: 'InqRes_ID'},
            {data: 'fullName', name: 'fullName'},
            {data: 'Cust_Email', name: 'Cust_Email'},
            {data: 'Inq_SendingDate', name: 'Inq_SendingDate'},
        ],
        "fnDrawCallback": function (oSettings) {
            mytooltipster();
            oTable.column(0).nodes().each(function (cell, i) {
                cell.innerHTML = (parseInt(oTable.page.info().start)) + i + 1;
            });
            var input=oSettings.oAjaxData;
            input.length="";
            input.start="";
            input=jQuery.param(input);
            input=input.replace("&length=", "");
            input=input.replace("&start=", "");
            $(".exportData").each(function(){
                $(this).attr("href",$(this).data("href")+input);
            });
        },
        //responsive: true,
        "autoWidth": false,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
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
        var this_val = $(this).val();
        if (this_val == "0") {
            this_val = "";
        }
        oTable.columns(column).search(this_val).draw();
    });

    $('#from, #to').change(function () {
        oTable.columns(6).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
    });

    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable.columns().search('').draw();
    });
});