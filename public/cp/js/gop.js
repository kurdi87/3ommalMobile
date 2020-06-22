
jQuery(document).ready(function () {
   // users.init();
    var flag = true;
    oTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()+ "&finance_party=" + $('#finance_partyN').val(),
        "order": [[ 0, "desc" ]],
        columnDefs: [
           //{orderable: false, targets: -1},
       //{orderable: false, targets: 0},
            {searchable: false, targets: 6},
            {searchable: false, targets: 4},
            {searchable: false, targets: 1},
        ],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'sid', name: 'sid'},

             {data: 'recipe', name: 'recipe'},
            {data: 'department', name: 'department'},
            {data: 'finance_party_name', name: 'finance_party_name'},
            {data: 'doctor', name: 'doctor'},
            {data: 'total_cost', name: 'total_cost'},
            {data: 'approved_cost', name: 'approved_cost'},
            {data: 'coverage_date', name: 'coverage_date'},
            {data: 'payment_date', name: 'payment_date'},
            {data: 'gop_action', name: 'gop_action'},
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
                $(this).attr("href", $(this).data("href") +"status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()+ "&finance_party=" + $('#finance_partyN').val(),+"&"+ input);
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
        var status=$('#statusN').attr('value',this.value);
        oTable.ajax.url("crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()+ "&finance_party=" + $('#finance_partyN').val()).load();
    });
    jQuery(document).on('change', '#action', function () {
        var action=$('#actionN').attr('value',this.value);
        oTable.ajax.url("crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()+ "&finance_party=" + $('#finance_partyN').val()).load();
    });
    jQuery(document).on('change', '#from', function () {
        var action=$('#to').attr('value',this.value);
        oTable.ajax.url("crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()+ "&finance_party=" + $('#finance_partyN').val()).load();
    });
    jQuery(document).on('change', '#to', function () {
        var action=$('#from').attr('value',this.value);
        oTable.ajax.url("crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()+ "&finance_party=" + $('#finance_partyN').val()).load();
    });
    jQuery(document).on('change', '#recipe', function () {
        var action=$('#hospitalN').attr('value',this.value);
        oTable.ajax.url("crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()+ "&finance_party=" + $('#finance_partyN').val()).load();
    });
    jQuery(document).on('change', '#doctor', function () {
        var action=$('#doctorN').attr('value',this.value);
        oTable.ajax.url("crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()+ "&finance_party=" + $('#finance_partyN').val()).load();
    });
    jQuery(document).on('change', '#department', function () {
        var action=$('#departmentN').attr('value',this.value);
        oTable.ajax.url("crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()+ "&finance_party=" + $('#finance_partyN').val()).load();
    });
    jQuery(document).on('change', '#finance_party', function () {
        var action=$('#finance_partyN').attr('value',this.value);
        oTable.ajax.url("crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()+ "&finance_party=" + $('#finance_partyN').val()).load();
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

    jQuery(document).on('click', '.visitModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#'+ target).modal('show');
        jQuery('.modal-body-visit').load('crm/gop/nextgop/'+eid);
        return false;
    });
    jQuery(document).on('submit', '#addVisit', function () {
        var thisAction = jQuery(this);
        //  var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/gop/addnextgop",

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

    jQuery(document).on('click', '.attPOmodal', function () {
        var attid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');
        jQuery('#modal-attPOadd').find(".id").val(attid);

        jQuery('#' + target).modal('show');
        return false;
    });
    jQuery(document).on('submit', '#addPOAtt', function () {
        var thisAction = jQuery(this);

        if (!errors) {
            jQuery.ajax({
                url: "crm/gop/addAtt",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {


                        jQuery('#modal-attPOadd').find('.form-control').val('');
                        jQuery('#modal-attPOadd').modal('hide');
                        jQuery('#modal-attPOadd').find('.upload-patient-att').css('background-image', 'url( "1.jpg")');

                        input_wlbl();
                        toasterMessage("success", data.message, "Updated Successfully");
                        oTable6 .draw();

                    }
                },
                error: function (data) {
                    toasterMessage("error", "Error", "Check Error");
                }
            });
        }

        return false;
    });
    jQuery(document).on('change', '.upload-patient-att', function () {

        if (flag == true) {


            jQuery('.modal-body-attach').find('.uploading').removeClass('hidden');
            flag = false;
            var my_file = this.files[0];
            var my_button = jQuery(this);
            var id=jQuery(this).attr('id');
            var size = parseInt(this.files[0].size);
            size = size / 1024;
            var file = jQuery(this).val();
            var extension = file.substr((file.lastIndexOf('.') + 1)).toLowerCase();
            var type = false;
            if (extension == 'jpg' || extension == 'jpeg' || extension == 'png'|| extension == 'pdf'|| extension == 'doc')
                type = true;

            if (size <= 4096 && type == true) {
                var fd = new FormData();
                fd.append("choose-file", my_file);
                jQuery.ajax({
                    url: 'crm/patient/uploadAtt/'+id,
                    type: 'POST',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {
                        //    my_button.parent().append('<div class="loading-submit"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
                    },
                    success: function (data) {
                        flag = true;
                        //    my_button.parent().find('.loading-submit').remove();
                        if (data.status == true) {
                            var src = "uploads/patient/" + data.file_name;

                            my_button.parents('.upload-patient-att').find('.icon').attr('value',data.file_name);
                            jQuery('.modal-body-attach').find('.uploading').addClass('hidden');
                            // my_button.parents('.upload-patient-att').find('.icon').attr('value',data.file_name);
                        }
                        else {
                            flag = true;
                            var message = data.message;
                            toasterMessage("error", message, "Upload Error");
                            jQuery('.modal-body-attach').find('.uploading').addClass('hidden');
                        }
                    }
                });

            } else {
                flag = true;
                my_button.parent().find('.loading-submit').remove();
                jQuery(this).val("");
                var message = '';
                if (size > 4096)
                    message = 'size is too big';
                if (type == false)
                    message = 'format not accepted';
                toasterMessage("error", message, "Upload Error");
            }
        }

    });



    jQuery(document).on('click', '.actionModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#'+ target).modal('show');
        jQuery('.modal-body-action').load('crm/gop/actiongop/'+eid);
        return false;
    });
    jQuery(document).on('submit', '#addAction', function () {
        var thisAction = jQuery(this);
        //  var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/gop/addactiongop",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        oTable.draw();

                        //  $("#pro_id option[value="+proid+"]").remove();

                        jQuery('#modal-action').find('.form-control').val('');
                        jQuery('#modal-action').modal('hide');

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
        oTable.ajax.url("crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"&recipe="+$('#hospitalN').val()+"&doctor="+$('#doctorN').val()+"&department="+$('#departmentN').val()).load();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select an option";


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
    jQuery(document).on('change', '#status', function () {
        var status=$('#statusN').attr('value',this.value);
        oTable.ajax.url('crm/gop/list?status='+this.value).load();
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
    jQuery(document).on('click', '.processModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#'+ target).modal('show');
        jQuery('.modal-body').load('crm/gop/process/'+eid);
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



                oTable.ajax.url("crm/gop/list?status="+$('#statusN').val()+"&action="+$('#actionN').val()+"&from="+$('#from').val()+"&to="+$('#to').val()).load();
                toasterMessage("success", data.message, "Mail Send Successfully");

            }
        });

        return false;
    });
    jQuery(document).on('click', '.emailModal', function () {
        var eid = jQuery(this).attr('data-id');


        var target = jQuery(this).attr('data-modal');

        jQuery('#' + target).modal('show');
        jQuery('.modal-body').load('crm/gop/email/' + eid);
        return false;
    });

    jQuery(document).on('submit', '#emailForm', function () {
        success:{
            toasterMessage("success", "", "Done");
        }

    });



});