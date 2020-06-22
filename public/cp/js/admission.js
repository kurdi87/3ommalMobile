jQuery(document).ready(function () {
    // users.init();
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/admission/list?status="+ $('#status').val()+ "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val(),
        "order": [[0, "desc"]],
        columnDefs: [
            //{orderable: false, targets: -1},
            //{orderable: false, targets: 0},
            {searchable: false, targets: 7},
            {searchable: false, targets: 1},
        ],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'sid', name: 'sid'},
            {data: 'event_id', name: 'event_id'},
            {data: 'event_no', name: 'event_no'},
            {data: 'hospital', name: 'hospital'},
            {data: 'department', name: 'department'},
            {data: 'finance_party_name', name: 'finance_party_name'},

            {data: 'admission_date', name: 'admission_date'},
            {data: 'active', name: 'active'},
            {data: 'm_action', name: 'm_action'},
            {data: 'expected_dis_date', name: 'expected_dis_date'},
            {data: 'discharge_date', name: 'discharge_date'},
            {data: 'days', name: 'days'},
            {data: 'case_manager', name: 'case_manager'},
            {data: 'employee', name: 'employee'},
            {data: 'coverage_cost', name: 'coverage_cost'},
            {data: 'visits', name: 'visits'},
            {data: 'commission', name: 'commission'},
            {data: 'accident_id', name: 'accident_id'},
            {data: 'accident_type', name: 'accident_type'},

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
                $(this).attr("href", $(this).data("href") + "status=" + $('#statusN').val() + "&employee=" + $('#employee').val(), +"&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&department=" + $('#department').val() + "&finance_party=" + $('#finance_party').val() + "&commission=" + $('#commissionN').val(), +input);
            });
        },
        // setup responsive extension: http://datatables.net/extensions/responsive/
    /*    responsive: {
            details: {
                renderer: function (api, rowIdx, columns) {
                    var data = $.map(columns, function (col, i) {
                        return col.hidden ?
                            '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                            '<td>' + col.title + ':' + '</td> ' +
                            '<td>' + col.data + '</td>' +
                            '</tr>' :
                            '';
                    }).join('');

                    return data ?
                        $('<table/>').append(data) :
                        false;
                }
            }},*/

            "autoWidth": false,
            "scrollX": false,
            "pagingType": "bootstrap_full_number"
            /*"drawCallback": function( settings ) {
                $('.tooltip-one-info').tooltipster('destroy');
            }*/
        });
    jQuery(document).on('click', '.processModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('.modal-body').load('crm/admission/process/' + eid);
        return false;
    });

    jQuery(document).on('click', '.visitModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('.modal-body-visit').load('crm/admission/visit/' + eid);
        return false;
    });
    jQuery(document).on('submit', '#addVisit', function () {
        var thisAction = jQuery(this);
        //  var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/admission/addVisit",

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


    jQuery(document).on('click', '.dischargeModal', function () {
        var eid = jQuery(this).attr('data-id');
        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
        jQuery('.modal-body-discharge').load('crm/admission/discharge/' + eid);
        return false;
    });
    jQuery(document).on('submit', '#addDischarge', function () {
        var thisAction = jQuery(this);
        //  var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/admission/addDischarge",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        oTable.draw();

                        //  $("#pro_id option[value="+proid+"]").remove();

                        jQuery('#modal-discharge').find('.form-control').val('');
                        jQuery('#modal-discharge').modal('hide');

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

    jQuery(document).on('click', '.visitViewModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('.modal-body-viewvisit').load('crm/admission/viewVisit/' + eid);
        return false;
    });

    jQuery(document).on('change', '.recommendation', function () {

        if (jQuery(this).prop("checked") == true) {
            jQuery(this).parents('.form-group').find('.option').removeClass('hidden');
        } else
            jQuery(this).parents('.form-group').find('.option').addClass('hidden');


        return false;
    });


    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable.draw();
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
    jQuery(document).on('change', '#status', function () {
        var status = $('#statusN').attr('value', this.value);
        oTable.ajax.url("crm/admission/list?status=" + $('#statusN').val() + "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val(),).load();
    });

    jQuery(document).on('change', '#hospital', function () {
        var status = $('#hospitalN').attr('value', $('#hospital').val());
        oTable.ajax.url("crm/admission/list?status=" + $('#statusN').val() + "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val(),).load();
    });

    jQuery(document).on('change', '#finance_party', function () {
        var status = $('#finance_partyN').attr('value', this.value);
        oTable.ajax.url("crm/admission/list?status=" + $('#statusN').val() + "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val(),).load();
    });

    jQuery(document).on('change', '#department', function () {
        var status = $('#departmentN').attr('value', this.value);
        oTable.ajax.url("crm/admission/list?status=" + $('#statusN').val() + "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val(),).load();
    });
    jQuery(document).on('change', '#employee', function () {
        var status = $('#employeeN').attr('value', this.value);
        oTable.ajax.url("crm/admission/list?status=" + $('#statusN').val() + "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val(),).load();
    });
    jQuery(document).on('change', '#commission', function () {
        var status = $('#commissionN').attr('value', this.value);
        oTable.ajax.url("crm/admission/list?status=" + $('#statusN').val() + "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val(),).load();
    });
    jQuery(document).on('change', '#from', function () {
        var status = $('#from').attr('value', this.value);
        oTable.ajax.url("crm/admission/list?status=" + $('#statusN').val() + "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val(),).load();
    });
    jQuery(document).on('change', '#to', function () {
        var status = $('#to').attr('value', this.value);
        oTable.ajax.url("crm/admission/list?status=" + $('#statusN').val() + "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val(),).load();
    });


    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        $('.select2').attr('value', 0);
        $('.filter').attr('value', 0);
        oTable.ajax.url("crm/admission/list?status=" + $('#statusN').val() + "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val(),).load();
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

                toasterMessage("success", data.message, "Updated Successfully");
                oTable.ajax.url("crm/admission/list?status=" + $('#statusN').val() + "&hospital=" + $('#hospital').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val() + "&finance_party=" + $('#finance_party').val() + "&department=" + $('#department').val() + "&employee=" + $('#employee').val() + "&commission=" + $('#commissionN').val()).load();
            }
        });

        return false;
    });


})