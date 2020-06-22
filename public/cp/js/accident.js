jQuery(document).ready(function () {
    // users.init();
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/accident/list?status=" + $('#statusN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&type=" + $('#typeN').val(),
        "order": [[0, "desc"]],
        columnDefs: [
            //{orderable: false, targets: -1},
            {orderable: false, targets: 6},
            {visible: false, targets: 13},
            {searchable: false, targets: 1},

        ],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'driver', name: 'driver'},
            {data: 'claim_no', name: 'claim_no'},
            {data: 'finance_party_name', name: 'finance_party_name'},
            {data: 'type_name', name: 'type_name'},
            {data: 'accident_date', name: 'accident_date'},
            {data: 'region_name', name: 'region_name'},

            {data: 'city', name: 'city'},
            {data: 'amount', name: 'amount'},
            {data: 'estimated_cost', name: 'estimated_cost'},
            {data: 'initial_cost', name: 'initial_cost'},
            {data: 'people', name: 'people'},
            {data: 'create_user', name: 'create_user'},
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
                $(this).attr("href", $(this).data("href")  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+ "&" + input);
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
        oTable.ajax.url("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#status', function () {
        var status = $('#statusN').attr('value', this.value);
        oTable.ajax.url("crm/accident/list?status="  + $('#statusN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+ "&type=" + $('#typeN').val()).load();
    });

    jQuery(document).on('change', '#type', function () {
        var action = $('#typeN').attr('value', this.value);
        oTable.ajax.url("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#finance_party', function () {
        var action = $('#finance_partyN').attr('value', this.value);
        oTable.ajax.url("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#region', function () {
        var action = $('#regionN').attr('value', this.value);
        oTable.ajax.url("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#from', function () {
        var action = $('#from').attr('value', this.value);
        oTable.ajax.url("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#to', function () {
        var action = $('#to').attr('value', this.value);
        oTable.ajax.url("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#hospital', function () {
        var action = $('#hospitalN').attr('value', this.value);
        oTable.ajax.url("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#city', function () {
        var action = $('#cityN').attr('value', this.value);
        oTable.ajax.url("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
    });
    jQuery(document).on('change', '#employee', function () {
        var action = $('#employeeN').attr('value', this.value);
        oTable.ajax.url(("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val())).load();
    });
    jQuery(document).on('change', '#accident_validity', function () {
        var action = $('#accident_validityN').attr('value', this.value);
        oTable.ajax.url(("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val())).load();
    });

    jQuery(document).on('change', '#uploaded', function () {
        var action = $('#uploadedN').attr('value', this.value);
        oTable.ajax.url(("crm/accident/list?status="  + $('#statusN').val() + "&type=" + $('#typeN').val() + "&accident_validity=" + $('#accident_validityN').val() + "&finance_party=" + $('#finance_partyN').val()+ "&hospital=" + $('#hospitalN').val()+ "&city=" + $('#cityN').val()+ "&employee=" + encodeURI($('#employeeN').val())+ "&region=" + $('#regionN').val()+ "&uploaded=" + $('#uploadedN').val()+"&from="+$('#from').val()+"&to="+$('#to').val())).load();
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
        oTable.ajax.url("crm/accident/list?status=" + $('#statusN').val() + "&action=" + $('#actionN').val() + "&from=" + $('#from').val() + "&to=" + $('#to').val()).load();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");



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
        oTable.ajax.url('crm/accident/list?status=' + this.value).load();
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
        jQuery('.modal-body').load('crm/accident/process/' + eid);
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
        jQuery('.modal-body-cstatus').load('crm/accident/cstatus/' + eid);
        return false;
    });
    jQuery(document).on('submit', '#addCstatus', function () {
        var thisAction = jQuery(this);
        //  var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/accident/addcstatus",

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