

jQuery(document).ready(function () {
    // users.init();
    var accident_id= jQuery(this).find('.accident_id').attr('value');
    var flag = true;
    oTable1 = $('#mydatatable1').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "crm/accident/listPatient/"+accident_id,
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
            {data: 'patient_type', name: 'patient_type'},
            {data: 'cost', name: 'cost'},
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
                .column( 4)
                .data()
                .reduce( function (a, b) {
                    return parseFloat(a)  + parseFloat(b) ;
                }, 0 );

            // Total over this page


            // Update footer
            $( api.column( 4 ).footer() ).html(
                '<input class="totalcostpatient form-control " name="tt" type="text" value="'+total+'">'
            );
            jQuery(document).find('.totalcostpatient').change();
        }


        /*"drawCallback": function( settings ) {
            $('.tooltip-one-info').tooltipster('destroy');
        }*/
    });
    $('#patient_id').select2({
        placeholder: 'Select patient',
        dropdownParent: $('#modal-Patientadd')
    });


    jQuery(document).on('click', '.btn-submit-search', function () {
        oTable1.draw();
    });

    jQuery(window).resize(function() {
        oTable1.columns().search('').draw();
    });

    jQuery(document).on('click','.sorting_1',function() {
        mytooltipster();
        $('.popovers').popover();
    });

    $('.searchable').change(function () {
        if (flag) {
            flag = false;
            var column = jQuery(this).attr('data-column');
            oTable1.columns(column).search(jQuery(this).val()).draw();
        }
        flag = true;
    });

    $('.searchableList').change(function () {
        var column = $(this).attr('data-column');
        oTable1.columns(column).search($(this).val()).draw();
    });




    jQuery(document).on('click', '.btn-reset', function () {
        $('.form-control').val('');
        oTable1.columns().search('').draw();
    });

    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select a State";


    jQuery(document).on('click', '.patientmodal', function () {
        var patientid = jQuery(this).parents('tr').find('.patientid').attr('data-id');
        jQuery(".id").val(patientid);
        jQuery('.totalcost').attr('value',0);
        jQuery('.patient').attr('value',0);
        jQuery('.events').hide();
        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
        return false;

    });
    jQuery(document).on('change', '.patient', function () {
        var accident_id= jQuery(document).find('.accident_id').attr('value');

        jQuery(this).parents('.addpro').find('.accidentpatient').load('crm/accident/getPatientInvoices/'+this.value+'?accident_id='+accident_id);
        return false;
    });

    jQuery(document).on('submit', '#addPatient', function () {
        var thisAction = jQuery(this);
        var patientid = jQuery(this).find('#patient_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/accident/addPatient",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {

                        oTable1.draw();
                        oTable5.draw();

                        $("#patient_id option[value="+patientid+"]").remove();

                        // jQuery('#modal-patientadd').find('.form-control').val('');

                        jQuery('#modal-patientadd').modal('hide');

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

    jQuery(document).on('click', '.patientEditmodal', function () {
        jQuery('#modal-patientEdit').find('.form-control').val('');
        var patientid = jQuery(this).attr('data-id');
        jQuery(".id").val(patientid);

        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
        jQuery('.modal-body').load('crm/accident/editPatient/'+patientid);
        return false;
    });

    jQuery(document).on('submit', '#editPatient', function () {
        var thisAction = jQuery(this);


        if (!errors) {
            jQuery.ajax({
                url: "crm/accident/storePatient",
                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {

                        oTable1.draw();
                        oTable5.draw();

                        jQuery('#modal-patientEdit').find('.form-control').val('');
                        jQuery('#modal-patientEdit').modal('hide');

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


    jQuery(document).on('click', '.eventcheckbox', function () {

        thisclick = jQuery(this);
        var cost=thisclick.parents('tr').find('.cost').attr('cost');
        var totalcost= thisclick.parents('form').find('.totalcost').val();
       if(totalcost=="") {
           totalcost = 0;
       }
        if(thisclick.is(":checked"))
            totalcost=parseFloat(totalcost)+parseFloat(cost);
        else {

            totalcost = parseFloat(totalcost) - parseFloat(cost);

        }
if(totalcost<0 || totalcost=="")
    totalcost = 0;
        thisclick.parents('form').find('.totalcost').attr('value',totalcost);

    });









    // for change status
    jQuery(document).on('click', '.btn-pstatus', function () {
        thisclick = jQuery(this);
        id=thisclick.parents('tr').find('.id').attr('item-id');
        value=thisclick.parents('tr').find('.id').attr('name');

        var status = "";
        if (thisclick.hasClass('pstatus-inactive'))
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

                    if (thisclick.hasClass('pstatus-active')) {

                        thisclick.removeClass('pstatus-active').addClass('pstatus-inactive');

                        thisclick.find('i').removeClass('fa-square-o').addClass('fa-check-square');
                        thisclick.parents('tr').find('.label').removeClass('label-success').addClass('label-danger');
                      //  thisclick.tooltipster('content', 'Activate');

                        $("#patient_id").append('<option value='+id+'>'+value+'</option>');


                    } else {

                        thisclick.removeClass('pstatus-inactive').addClass('pstatus-active');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.label').removeClass('label-danger').addClass('label-success');
                        //thisclick.tooltipster('content', 'Deactivate');
                    }
                    oTable1.draw();

                    toasterMessage("success", data.message, "Updated Successfully");

                }
            });
        }

        return false;
    });


});