
var BookDate = function () {

    var handleBtnClear = function () {
        jQuery(document).on('click', '.cleardate', function () {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            input_wlbl();
            oTable.columns(4).search(jQuery('#from').val() + '|' + jQuery('#to').val()).draw();
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

    BookDate.init();

    var flag = true;

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";

    $(".changerole-mselect2").select2({
        placeholder: placeholder,
        width: null
    });

    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "cp-attar/booking/list",
        "order": [[4, 'desc']],
        columnDefs: [
            {orderable: false, targets: 0},
            {searchable: false, targets: 4},
        ],
        "columns": [
            {data: 'PCR_ID', name: 'PCR_ID'},
            {data: 'fullName', name: 'fullName'},
            {data: 'Cust_MobileNo', name: 'Cust_MobileNo'},
            {data: 'Pack_EnglishTitle', name: 'Pack_EnglishTitle'},
            {data: 'PCR_CreatedDate', name: 'PCR_CreatedDate'},
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

    jQuery(window).resize(function() {
        oTable.columns().search('').draw();
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable.draw();
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