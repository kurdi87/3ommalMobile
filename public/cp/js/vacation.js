jQuery(document).ready(function () {
    // users.init();
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/vacation/list?status=" + $('#status').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&type=" + $('#type').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val(),
        "order": [[0, "desc"]],
        columnDefs: [
            //{orderable: false, targets: -1},
            {searchable: false, targets: 0},
            {searchable: false, targets: 2},
            {searchable: false, targets: 3},
            {searchable: false, targets: 4},
            {searchable: false, targets: 5},
            {searchable: false, targets: 6},
            {searchable: false, targets: 7},
            {searchable: false, targets: 8},
            {searchable: false, targets: 9},
            {searchable: false, targets: 10},

        ],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'type', name: 'type'},

            {data: 'empno', name: 'empno'},
            {data: 'department', name: 'department'},
            {data: 'from_date', name: 'from_date'},
            {data: 'to_date', name: 'to_date'},
            {data: 'days', name: 'days'},
            {data: 'submit_date', name: 'submit_date'},

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
                $(this).attr("href", $(this).data("href") + "status=" + $('#status').val() + "&action=" + $('#action').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&recipe=" + $('#recipe').val() + "&doctor=" + $('#doctor').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&finance_party=" + $('#finance_party').val(), +"&" + input);
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
        oTable.draw();
    });
    jQuery(document).on('change', '#status', function () {
        var status = $('#status').attr('value', this.value);
        oTable.ajax.url("crm/vacation/list?status=" + $('#status').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&type=" + $('#type').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val()).load();
    });

    jQuery(document).on('change', '#from', function () {
        var action = $('#to').attr('value', this.value);
        oTable.ajax.url("crm/vacation/list?status=" + $('#status').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&type=" + $('#type').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val()).load();
    });
    jQuery(document).on('change', '#to', function () {
        var action = $('#from').attr('value', this.value);
        oTable.ajax.url("crm/vacation/list?status=" + $('#status').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&type=" + $('#type').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val()).load();
    });

    jQuery(document).on('change', '#type', function () {
        var action = $('#type').attr('value', this.value);
        oTable.ajax.url("crm/vacation/list?status=" + $('#status').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&type=" + $('#type').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val()).load();
    });
    jQuery(document).on('change', '#department', function () {
        var action = $('#department').attr('value', this.value);
        oTable.ajax.url("crm/vacation/list?status=" + $('#status').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&type=" + $('#type').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val()).load();
    });
    jQuery(document).on('change', '#employee', function () {
        var action = $('#employee').attr('value', this.value);
        oTable.ajax.url("crm/vacation/list?status=" + $('#status').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&type=" + $('#type').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val()).load();
    });


    jQuery(document).on('click', '.sorting_1', function () {
        mytooltipster();
        $('.popovers').popover();
    });

    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-colum');
            oTable.columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-colum');
        oTable.columns(column).search($(this).val()).draw();
    });

    jQuery(document).on('click', '.visitModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('.modal-body-visit').load('crm/vacation/nextvacation/' + eid);
        return false;
    });
    jQuery(document).on('submit', '#addVisit', function () {
        var thisAction = jQuery(this);
        //  var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/vacation/addnextvacation",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        oTable.draw();

                        //  $("#pro_id option[value="+proid+"]").remove();

                        jQuery('#modal-visit').find('.form-control').val('');
                        jQuery('#modal-visit').modal('hide');

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


    jQuery(document).on('click', '.actionModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('.modal-body-actio').load('crm/vacation/actionvacation/' + eid);
        return false;
    });
    jQuery(document).on('submit', '#addAction', function () {
        var thisAction = jQuery(this);
        //  var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/vacation/addactionvacation",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        oTable.draw();

                        //  $("#pro_id option[value="+proid+"]").remove();

                        jQuery('#modal-actio').find('.form-control').val('');
                        jQuery('#modal-actio').modal('hide');

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


    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable.ajax.url("crm/vacation/list?status=" + $('#status').val() + "&action=" + $('#action').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&recipe=" + $('#recipe').val() + "&doctor=" + $('#doctor').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val()).load();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select an option";


    jQuery(document).on('click', '.btn-dropdown-wstatus', function () {
        if (jQuery(this).attr('disabled') != "disabled") {
            if (jQuery(this).parents('.btn-dropdown-wstatusrg').hasClass('ope')) {
                jQuery(this).parents('.btn-dropdown-wstatusrg').removeClass('ope');
            } else {
                jQuery(this).parents('.btn-dropdown-wstatusrg').addClass('ope');
            }
        }
    });
    jQuery(document).on('change', '#status', function () {
        var status = $('#status').attr('value', this.value);
        oTable.ajax.url('crm/vacation/list?status=' + this.value).load();
    });
    jQuery(document).on('click', '.btn-dropdown-wselect', function () {
        if (jQuery(this).attr('disabled') != "disabled") {
            if (jQuery(this).parents('.btn-dropdownrg').hasClass('ope')) {
                jQuery(this).parents('.btn-dropdownrg').removeClass('ope');
            } else {
                jQuery(this).parents('.btn-dropdownrg').addClass('ope');
            }
        }
    });

    jQuery(document).on('click', 'body', function (e) {
        var target = $(e.target);
        if (!$(e.target).is('.dropdown-wselect, .dropdown-wselect *, .btn-dropdown-wselect, .btn-dropdown-wselect *,.select2-search__field')) {
            $('.btn-dropdownrg').removeClass('ope');
        }
    });
    jQuery(document).on('click', '.processModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('.modal-body').load('crm/vacation/process/' + eid);
        return false;
    });
    jQuery(document).on('click', 'body', function (e) {
        var target = $(e.target);
        if (!$(e.target).is('.btn-dropdown-wstatusrg ,.btn-dropdown-wstatus, .btn-dropdown-wstatus *')) {
            $('.btn-dropdown-wstatusrg').removeClass('ope');
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

    jQuery(document).on('click', '.reminder', function () {
        thisclick = jQuery(this);

        jQuery.ajax({
            url: jQuery(this).attr('link'),
            type: 'GET',
            success: function (data) {


                oTable.ajax.url("crm/vacation/list?status=" + $('#status').val() + "&action=" + $('#action').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val()).load();
                toasterMessage("success", data.message, "Mail Send Successfully");

            }
        });

        return false;
    });
    jQuery(document).on('click', '.emailModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('.modal-body').load('crm/vacation/email/' + eid);
        return false;
    });

    jQuery(document).on('submit', '#emailForm', function () {
        success:{
            toasterMessage("success", "", "Done");
        }

    });


});