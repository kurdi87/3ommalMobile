/*var menu = function () {

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

}();*/

jQuery(document).ready(function () {
   // users.init();
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "ecareer/department/list",
        "order": [[ 1, "desc" ]],
        columnDefs: [
           {orderable: false, targets: -1},
       {orderable: false, targets: 0},
            //{searchable: false, targets: 7},
            //{searchable: false, targets: 1},
        ],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'language', name: 'language'},
            {data: 'keywords', name: 'keywords'},
             {data: 'icon', name: 'icon'},
            {data: 'd_order', name: 'd_order'},
             {data: 'active', name: 'active'},
            {data: 'm_action', name: 'm_action'}
        ],
        "fnDrawCallback": function (oSettings) {
            mytooltipster();
            $('.popovers').popover();
            App.init();
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
        // setup responsive extension: http://datatables.net/extensions/responsive/
        //responsive: true,
        "autoWidth": false,
        "pageLength": 30,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
        /*"drawCallback": function( settings ) {
            $('.tooltip-one-info').tooltipster('destroy');
        }*/
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




    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable.columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";


    jQuery(document).on('click', '.btn-dropdown-wstatus', function () {
        if (jQuery(this).attr('disabled') != "disabled") {
            if (jQuery(this).parents('.btn-dropdown-wstatusrg').hasClass('open')) {
                jQuery(this).parents('.btn-dropdown-wstatusrg').removeClass('open');
            }
            else {
                jQuery(this).parents('.btn-dropdown-wstatusrg').addClass('open');
            }
        }
    });

    jQuery(document).on('click', '.btn-dropdown-wselect', function () {
        if (jQuery(this).attr('disabled') != "disabled") {
            if (jQuery(this).parents('.btn-dropdownrg').hasClass('open')) {
                jQuery(this).parents('.btn-dropdownrg').removeClass('open');
            }
            else {
                jQuery(this).parents('.btn-dropdownrg').addClass('open');
            }
        }
    });

    jQuery(document).on('click', 'body', function (e) {
        var target = $(e.target);
        if (!$(e.target).is('.dropdown-wselect, .dropdown-wselect *, .btn-dropdown-wselect, .btn-dropdown-wselect *,.select2-search__field')) {
            $('.btn-dropdownrg').removeClass('open');
        }
    });

    jQuery(document).on('click', 'body', function (e) {
        var target = $(e.target);
        if (!$(e.target).is('.btn-dropdown-wstatusrg ,.btn-dropdown-wstatus, .btn-dropdown-wstatus *')) {
            $('.btn-dropdown-wstatusrg').removeClass('open');
        }
    });



    // for change status
    jQuery(document).on('click', '.btn-mstatus', function () {
        thisclick = jQuery(this);
        var status = "";
        if (thisclick.hasClass('mstatus-inactive'))
            status = "0";
        else
            status = "1";
        jQuery.ajax({
            url: jQuery(this).attr('link'),
            type: 'GET',
            data: {"id[]": thisclick.parents('tr').find('.id').attr('data-id'), status: status},
            dataType: "json",
            success: function (data) {

                if (thisclick.hasClass('mstatus-active')) {

                    thisclick.removeClass('mstatus-active').addClass('mstatus-inactive');

                    thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                    thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                    thisclick.tooltipster('content', 'Activate');

                } else {

                    thisclick.removeClass('mstatus-inactive').addClass('mstatus-active');
                    thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                    thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                    thisclick.tooltipster('content', 'Deactivate');
                }
                oTable.draw();
                toasterMessage("success", data.message, "Updated Successfully");

            }
        });

        return false;
    });


    jQuery(document).on('click', '.btn-delete', function () {
        thisclick = jQuery(this);
        var status = "";

        jQuery.ajax({
            url: jQuery(this).attr('link'),
            type: 'GET',
            data: {"id[]": thisclick.parents('tr').find('.id').attr('data-id'), status: status},
            dataType: "json",
            success: function (data) {

                oTable.draw();
                toasterMessage("success", data.message, "Updated Successfully");

            }

        });

        return false;
    });

});