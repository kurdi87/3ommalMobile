jQuery(document).ready(function () {
    // users.init();
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/revenue/list?type=" + $('#typeN').val()  + "&month=" + $('#monthN').val() + "&year=" + $('#yearN').val()+ "&employee=" + $('#employeeN').val(),
        "order": [[0, "desc"]],
        columnDefs: [
            //{orderable: false, targets: -1},
            //{orderable: false, targets: 0},

            {searchable: false, targets: 1},

        ],
        "columns": [
            {data: 'id', name: 'id'},
           
            
            {data: 'type', name: 'type'},
            {data: 'revenue_date', name: 'revenue_date'},
            {data: 'amount', name: 'amount'},
            {data: 'month', name: 'month'},
            {data: 'year', name: 'year'},
            {data: 'active', name: 'active'},
            {data: 'm_action', name: 'm_action'}
        ],
        "fnDrawCallback": function (oSettings) {
            mytooltipster();
            $('.popovers').popover();
            App.init();
            var input = oSettings.oAjaxData;
            input.length = "";
            input.start = "";
            input = jQuery.param(input);
            input = input.replace("&length=", "");
            input = input.replace("&start=", "");
            $(".exportData").each(function () {
                $(this).attr("href", $(this).data("href") + "type=" + $('#typeN').val()  + "&month=" + $('#monthN').val() + "&year=" + $('#yearN').val()+ "&employee=" + $('#employeeN').val() + "&" + input);
            });
        },
        // setup responsive extension: http://datatables.net/extensions/responsive/
        //responsive: true,
        "autoWidth": false,
        "scrollX": true,
        "pagingType": "bootstrap_full_number"
        /*"drawCallback": function( settings ) {
            $('.tooltip-one-info').tooltipster('destroy');            
        }*/
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable.ajax.url("crm/revenue/list?type=" + $('#typeN').val()  + "&month=" + $('#monthN').val() + "&year=" + $('#yearN').val()+ "&employee=" + $('#employeeN').val()).load();
    });
    jQuery(document).on('change', '#type', function () {
        var status = $('#typeN').attr('value', this.value);
        oTable.ajax.url("crm/revenue/list?type=" + $('#typeN').val()  + "&month=" + $('#monthN').val() + "&year=" + $('#yearN').val()+ "&employee=" + $('#employeeN').val()).load();
    });
    jQuery(document).on('change', '#employee', function () {
        var status = $('#employeeN').attr('value', this.value);
        oTable.ajax.url("crm/revenue/list?type=" + $('#typeN').val()  + "&month=" + $('#monthN').val() + "&year=" + $('#yearN').val()+ "&employee=" + $('#employeeN').val()).load();
    });


    jQuery(document).on('change', '#month', function () {
        var action = $('#monthN').attr('value', this.value);
        oTable.ajax.url("crm/revenue/list?type=" + $('#typeN').val()  + "&month=" + $('#monthN').val() + "&year=" + $('#yearN').val()+ "&employee=" + $('#employeeN').val()).load();
    });
    jQuery(document).on('change', '#year', function () {
        var action = $('#yearN').attr('value', this.value);
        oTable.ajax.url("crm/revenue/list?type=" + $('#typeN').val()  + "&month=" + $('#monthN').val() + "&year=" + $('#yearN').val()+ "&employee=" + $('#employeeN').val()).load();
    });




    jQuery(document).on('click', '.sorting_1', function () {
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
        oTable.ajax.url("crm/revenue/list?type=" + $('#typeN').val()  + "&month=" + $('#monthN').val() + "&year=" + $('#yearN').val()+ "&employee=" + $('#employeeN').val()).load();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select an option";


    jQuery(document).on('click', '.btn-dropdown-wstatus', function () {
        if (jQuery(this).attr('disabled') != "disabled") {
            if (jQuery(this).parents('.btn-dropdown-wstatusrg').hasClass('open')) {
                jQuery(this).parents('.btn-dropdown-wstatusrg').removeClass('open');
            } else {
                jQuery(this).parents('.btn-dropdown-wstatusrg').addClass('open');
            }
        }
    });
    jQuery(document).on('change', '#status', function () {
        var status = $('#statusN').attr('value', this.value);
        oTable.ajax.url('crm/revenue/list?status=' + this.value).load();
    });
    jQuery(document).on('click', '.btn-dropdown-wselect', function () {
        if (jQuery(this).attr('disabled') != "disabled") {
            if (jQuery(this).parents('.btn-dropdownrg').hasClass('open')) {
                jQuery(this).parents('.btn-dropdownrg').removeClass('open');
            } else {
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
    jQuery(document).on('click', '.processModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('.modal-body').load('crm/revenue/process/' + eid);
        return false;
    });
    jQuery(document).on('click', 'body', function (e) {
        var target = $(e.target);
        if (!$(e.target).is('.btn-dropdown-wstatusrg ,.btn-dropdown-wstatus, .btn-dropdown-wstatus *')) {
            $('.btn-dropdown-wstatusrg').removeClass('open');
        }
    });


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
    jQuery(document).on('click', '.cstatusModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('.modal-body-cstatus').load('crm/revenue/cstatus/' + eid);
        return false;
    });
    jQuery(document).on('submit', '#addCstatus', function () {
        var thisAction = jQuery(this);
        //  var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/revenue/addcstatus",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        oTable.draw();

                        //  $("#pro_id option[value="+proid+"]").remove();

                        jQuery('#modal-cstatus').find('.form-control').val('');
                        jQuery('#modal-cstatus').modal('hide');

                        input_wlbl();
                        toasterMessage("success", data.message, "Updated Successfully");

                    }
                },
                error: function (data) {
                    toasterMessage("error", "Error", "Check Error");
                }
            });
        }

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