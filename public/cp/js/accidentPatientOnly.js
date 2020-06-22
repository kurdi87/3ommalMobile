

jQuery(document).ready(function () {
    // users.init();
    var accident_id= jQuery(this).find('.accident_id').attr('value');
    var flag = true;

    oTable5 = $('#mydatatable5').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/accident/listPatientOnly/"+accident_id,
        "order": [[ 1, "desc" ]],
        columnDefs: [
            //{orderable: false, targets: -1},
            //{orderable: false, targets: 0},
            //{searchable: false, targets: 7},
            //{searchable: false, targets: 1},
        ],
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'sid', name: 'sid'},
            {data: 'estimated_cost', name: 'estimated_cost'},
            {data: 'hospital', name: 'hospital'},
            {data: 'patient_type', name: 'patient_type'},
            {data: 'active', name: 'active'},
            {data: 'm_action', name: 'm_action'}
        ],

        // setup responsive extension: http://datatables.net/extensions/responsive/
        //responsive: true,
        "paging": false,
        "autoWidth": false,
        "scrollX": true,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                if(typeof i === 'string') {
                    let multiplier = /[\(\)]/g.test(i) ? -1 : 1;

                    return (i.replace(/[\$,\(\)]/g, '') * multiplier)
                }

                return typeof i === 'number' ?
                    i : 0;
            };


            // Total over all pages
            total = api
                .column( 3)
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a)  + parseFloat(b) ;
                }, 0 );

            // Total over this page


            // Update footer
            $( api.column( 4 ).footer() ).html(
                '<input class="totalcostPatientOnly form-control " name="tt" type="text" value="'+total+'">'
            );
            jQuery(document).find('.estcost').attr('value',total);
        }


        /*"drawCallback": function( settings ) {
            $('.tooltip-one-info').tooltipster('destroy');
        }*/
    });

    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable5.draw();
        oTable1.draw();
    });

    jQuery(window).resize(function() {
        oTable5.columns().search('').draw();
    });

    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
    });

    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            oTable5.columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        oTable5.columns(column).search($(this).val()).draw();
    });




    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable5.columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";


    jQuery(document).on('click', '.PatientOnlymodal', function () {
        var PatientOnlyid = jQuery(this).parents('tr').find('.PatientOnlyid').attr('data-id');
        jQuery(".id").val(PatientOnlyid);
        jQuery('.totalcost').attr('value',0);
        jQuery('.PatientOnly').attr('value',0);
        jQuery('.events').hide();
        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
        return false;

    });
    $('#patientOnly_id').select2({
        placeholder: 'Select patient',
        dropdownParent: $('#modal-PatientOnlyadd')
    });
    $('.patientchoose2').select2({
        placeholder: 'Select an option',
        dropdownParent:  $('#modal-patientOnlyEdit')
    });
    $('.patientchoose').select2({
        placeholder: 'Select an option',
        dropdownParent:  $('#modal-PatientOnlyadd')
    });
    jQuery(document).on('change', '.PatientOnly', function () {
        var accident_id= jQuery(document).find('.accident_id').attr('value');

        jQuery(this).parents('.addpro').find('.accidentPatientOnly').load('crm/accident/getPatientOnlyInvoices/'+this.value+'?accident_id='+accident_id);
        return false;
    });

    jQuery(document).on('submit', '#addPatientOnly', function () {
        var thisAction = jQuery(this);
        var PatientOnlyid = jQuery(this).find('#patientOnly_id :selected').val();
        var Patienttext = jQuery(this).find('#patientOnly_id :selected').text();

        if (!errors) {
            jQuery.ajax({
                url: "crm/accident/addPatientOnly",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {

                        oTable1.draw();
                        oTable5.draw();

                        $("#patientOnly_id option[value="+PatientOnlyid+"]").remove();

                        var newOption = new Option(Patienttext, PatientOnlyid, true, true);
                        // Append it to the select
                        $('#patient_id ').append(newOption).trigger('change');
                        $('#patient_id').val(null).trigger('change');
                        // jQuery('#modal-PatientOnlyadd').find('.form-control').val('');

                        jQuery('#modal-PatientOnlyadd').modal('hide');

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
                url: "crm/patient/addAtt",
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






    // for change status
    jQuery(document).on('click', '.btn-attPO-status', function () {
        thisclick = jQuery(this);
        var status = "";
        if (thisclick.hasClass('att-inactive'))
            status = "0";
        else
            status = "1";
        if (confirm("This will delete item...Are you sure?"))
        {
            jQuery.ajax({
                url: jQuery(this).attr('href'),
                type: 'GET',
                data: {"id[]": thisclick.parents('tr').find('.id').attr('data-id'), status: status},
                dataType: "json",
                success: function (data) {

                    if (thisclick.hasClass('att-active')) {

                        thisclick.removeClass('att-active').addClass('att-inactive');

                        thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                        thisclick.tooltipster('content', 'Activate');


                    } else {

                        thisclick.removeClass('att-inactive').addClass('att-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        thisclick.tooltipster('content', 'Deactivate');
                    }
                    oTable3 .draw();

                    toasterMessage("success", data.message, "Updated Successfully");

                }
            });
        }
        return false;
    });



    jQuery(document).on('click', '.patientOnlyEditmodal', function () {
        jQuery('#modal-patientOnlyEdit').find('.form-control').val('');
        var patientOnlyid = jQuery(this).attr('data-id');
        jQuery(".id").val(patientOnlyid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
        jQuery('#' + target).find('.form-control').val('');
        jQuery('#' + target).find('.select2').val('0');
        jQuery('.modal-body').load('crm/accident/editPatientOnly/'+patientOnlyid);



    });

    jQuery(document).on('submit', '#editOnlyPatient', function () {
        var thisAction = jQuery(this);


        if (!errors) {
            jQuery.ajax({
                url: "crm/accident/storePatientOnly",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {

                        oTable5.draw();
                        oTable1.draw();
                        jQuery('#modal-patientOnlyEdit').find('.form-control').val('');
                        jQuery('#modal-patientOnlyEdit').modal('hide');

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









    // for change status
    jQuery(document).on('click', '.btn-postatus', function () {
        thisclick = jQuery(this);
        id=thisclick.parents('tr').find('.id').attr('item-id');
        value=thisclick.parents('tr').find('.id').attr('name');

        var status = "";
        if (thisclick.hasClass('postatus-inactive'))
            status = "0";
        else
            status = "1";
        if (confirm("This will delete item...Are you sure?"))
        {
            jQuery.ajax({
                url: jQuery(this).attr('href'),
                type: 'GET',
                data: {"id[]": thisclick.parents('tr').find('.id').attr('data-id'), status: status},
                dataType: "json",
                success: function (data) {

                    if (thisclick.hasClass('postatus-active')) {

                        thisclick.removeClass('postatus-active').addClass('postatus-inactive');

                        thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                      //  thisclick.tooltipster('content', 'Activate');

                        $("#PatientOnly_id").append('<option value='+id+'>'+value+'</option>');


                    } else {

                        thisclick.removeClass('postatus-inactive').addClass('postatus-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        //thisclick.tooltipster('content', 'Deactivate');
                    }
                    oTable5.draw();
                    oTable1.draw();

                    toasterMessage("success", data.message, "Updated Successfully");

                }
            });
        }

        return false;
    });


});