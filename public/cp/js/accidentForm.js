jQuery(document).ready(function () {
    var flag = true;
    var accident_type =  jQuery('.accident_type').val();

    if (accident_type > 0)
    {
        $('.accident_form').removeClass('hidden');
        if(accident_type==156) {
            $('.car_accident').removeClass('hidden');
            $('.other_accident').addClass('hidden');
        }
        else
        {
            $('.other_accident').removeClass('hidden');
            $('.car_accident').addClass('hidden');
        }
    }
    else
        $('.accident_form').addClass('hidden');

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.praccidentDefault();
                return false;
            }
        });
    });

    jQuery(document).on('change', '.totalcostpatient', function () {
        var totalcostpatient = jQuery(this).val();
        if (totalcostpatient == '')
            totalcostpatient = 0;
        jQuery(this).parents('.form-package').find('.amount').attr('value', totalcostpatient);
        return false;
    });
    jQuery(document).on('change', '.accident_type', function () {
        var accident_type = this.value;
        if (accident_type > 0)
        {
            $('.accident_form').removeClass('hidden');
            if(accident_type==156) {
                $('.car_accident').removeClass('hidden');
                $('.other_accident').addClass('hidden');
            }
            else
                {
                    $('.other_accident').removeClass('hidden');
                    $('.car_accident').addClass('hidden');
                }
        }
        else
            $('.accident_form').addClass('hidden');


    });

    $(".send").click(function () {
        thisclick = jQuery(this);
        var vehicle_id = jQuery('#vehicle_id').val();
        var accident_date2 = jQuery('#accident_date2').val();
        jQuery.ajax({
            url: 'crm/accident/getData?vehicle_id=' + vehicle_id+'&accident_date2='+accident_date2,
            type: 'GET',
            beforeSend: function () {
                $('.import').addClass('hidden');
                $('.loading').removeClass('hidden');
            },
            complete: function () {
                $('.import').removeClass('hidden');
                $('.loading').addClass('hidden');
            },
            success: function (data) {
                if (!data.data['error']) {
                    var a1 = data.data['result']['PICDetails']['POLI_BRANCH'];
                    var a2 = data.data['result']['PICDetails']['POLI_OFFICE'];
                    var a3 = data.data['result']['PICDetails']['POLI_DOC_NO'];
                    var a4 = data.data['result']['PICDetails']['POLI_UW_YEAR'];
                    var a5 = data.data['result']['PICDetails']['POLI_DOC_TYPE'];
                    var a6 = data.data['result']['PICDetails']['POLI_MAJ_INS_TYPE'];
                    var a7 = data.data['result']['PICDetails']['POLI_MIN_INS_TYPE'];
                    var a8 = data.data['result']['PICDetails']['POLI_POL_NO'];
                    var a9 = data.data['result']['PICDetails']['POLI_MO_PLATE_NO'];
                    var a10 = data.data['result']['insurer_id'];
                    var a12 = data.data['result']['insurer']['id'];
                    var a14 = data.data['result']['insured_details']['client_id'];
                    var a15 = data.data['result']['insured_details']['name'];
                    var a16 = data.data['result']['insured_details']['national_id'];
                    var a17 = data.data['result']['insured_details']['email'];
                    var a18 = data.data['result']['insured_details']['phone'];
                    var a20 = data.data['result']['insured_details']['address']['country'];
                    var a21 = data.data['result']['insured_details']['address']['locality'];
                    var a22 = data.data['result']['insured_details']['address']['number'];
                    var a23 = data.data['result']['insured_details']['address']['street'];
                    var a24 = data.data['result']['insured_details']['address']['zipCode'];
                    var a25 = data.data['result']['insured_details']['birthday'];
                    var a26 = data.data['result']['insured_details']['license_number'];
                    var a27 = data.data['result']['insured_details']['license_date'];
                    var a29 = data.data['result']['insurance']['policy_id'];
                    var a30 = data.data['result']['insurance']['policy_start'];
                    var a31 = data.data['result']['insurance']['policy_end'];
                    var a32 = data.data['result']['insurance']['policy_type'];
                    var a33 = data.data['result']['insurance']['personsAuthorizedToDrive'];
                    var a34 = data.data['result']['insurance']['licenseIssueDate'];
                    var a36 = data.data['result']['insurance']['insurance_amount']['amount'];
                    var a37 = data.data['result']['insurance']['insurance_amount']['currency'];
                    var a39 = data.data['result']['vehicle']['vehicleModel'];
                    var a40 = data.data['result']['vehicle']['vehicleModelID'];
                    var a41 = data.data['result']['vehicle']['vehicleSubModel'];
                    var a42 = data.data['result']['vehicle']['vehicleSubModelID'];
                    var a43 = data.data['result']['vehicle']['subModelCode'];
                    var a44 = data.data['result']['vehicle']['year'];
                    var a45 = data.data['result']['vehicle']['engine_volume'];
                    var a46 = data.data['result']['vehicle']['chassis'];
                    var a47 = data.data['result']['vehicle']['license_number'];
                    var a48 = data.data['result']['created'];
                    $('#claim_no').attr('value', a1 + '-' + a2 + '-' + a3 + '-' + a4 + '-' + a5 + '-' + a6 + '-' + a7);
                    $('#claim_no').addClass('text-danger');
                    $('#accident_id_pic').attr('value',JSON.stringify(data.data['result']['PICDetails']));
                    $('#vehicle_no').attr('value', a47);
                    $('#vehicle_no').addClass('text-danger');
                    $('#vehicle_type').attr('value', a39);
                    $('#vehicle_type').addClass('text-danger');
                    $('#vehicle_cat').attr('value', a40);
                    $('#vehicle_cat').addClass('text-danger');
                    $('#vehicle_br').attr('value', a41);
                    $('#vehicle_br').addClass('text-danger');
                    $('#vehicle_sn').attr('value', a46);
                    $('#vehicle_sn').addClass('text-danger');
                    $('#motor').attr('value', a45);
                    $('#motor').addClass('text-danger');
                    $('#fuel_type').attr('value', '0');
                    $('#fuel_type').addClass('text-danger');
                    $('#gear_type').attr('value', '0');
                    $('#gear_type').addClass('text-danger');
                    $('#color').attr('value', '0');
                    $('#color').addClass('text-danger');
                    $('#usage').attr('value', '0');
                    $('#usage').addClass('text-danger');
                    $('#production_year').attr('value', a44);
                    $('#production_year').addClass('text-danger');
                    $('#policy_no').attr('value', a29);
                    $('#policy_no').addClass('text-danger');
                    $('#POLI_DOC_NO').attr('value', a3);
                    $('#POLI_DOC_NO').addClass('text-danger');
                    $('#policy_start_date').attr('value', a30);
                    $('#policy_start_date').addClass('text-danger');
                    $('#policy_end_date').attr('value', a31);
                    $('#policy_end_date').addClass('text-danger');
                    $('#policy_type').attr('value', a32);
                    $('#policy_type').addClass('text-danger');
                    $('#driver').attr('value', a33);
                    $('#driver').addClass('text-danger');
                    $('#driver').attr('value', a33);
                    $('#driver').addClass('text-danger');
                    $('#accident_date2').attr('value', a33);;
                    $('#accident_date2').addClass('text-danger');
                    $('#accident_date').attr('value', a33);;
                    $('#accident_date').addClass('text-danger');
                    // $('#POLI_BRANCH').attr('value',a1);
                    // $('#POLI_OFFICE').attr('value',a2);

                    // $('#POLI_UW_YEAR').attr('value',a4);
                    // $('#POLI_DOC_TYPE').attr('value',a5);
                    // $('#POLI_MAJ_INS_TYPE').attr('value',a6);
                    // $('#POLI_MIN_INS_TYPE').attr('value',a7);
                    // $('#POLI_POL_NO').attr('value',a8);
                    // $('#POLI_MO_PLATE_NO').attr('value',a9);
                    // $('#insurer_id').attr('value',a10);
                    // $('#claim_no').attr('value',);
                    // $('#id').attr('value',a12);
                    // $('#client_id').attr('value',a14);
                    // $('#name').attr('value',a15);
                    // $('#national_id').attr('value',a16);
                    // $('#email').attr('value',a17);
                    // $('#phone').attr('value',a18);
                    // $('#country').attr('value',a20);
                    // $('#locality').attr('value',a21);
                    // $('#number').attr('value',a22);
                    // $('#street').attr('value',a23);
                    // $('#zipCode').attr('value',a24);
                    // $('#birthday').attr('value',a25);
                    // $('#license_number').attr('value',a26);
                    // $('#license_date').attr('value',a27);
                    // $('#policy_id').attr('value',a29);
                    // $('#policy_start').attr('value',a30);
                    // $('#policy_end').attr('value',a31);
                    // $('#policy_type').attr('value',a32);
                    // $('#personsAuthorizedToDrive').attr('value',a33);
                    // $('#licenseIssueDate').attr('value',a34);
                    // $('#amount').attr('value',a36);
                    // $('#currency').attr('value',a37);
                    // $('#vehicleModel').attr('value',a39);
                    // $('#vehicleModelID').attr('value',a40);
                    // $('#vehicleSubModel').attr('value',a41);
                    // $('#vehicleSubModelID').attr('value',a42);
                    // $('#subModelCode').attr('value',a43);
                    // $('#year').attr('value',a44);
                    // $('#engine_volume').attr('value',a45);
                    // $('#chassis').attr('value',a46);
                    // $('#license_number').attr('value',a47);
                    // $('#created').attr('value',a48);


                    toasterMessage("success", data.message, "Imported Successfully");
                } else
                    toasterMessage("error", 'Please Choose correct vehicle number', "Import Failed");

            },


        });
    });

    $(".uploadData").click(function () {
        thisclick = jQuery(this);
        var accident_id = jQuery('#accident_id').val();

        jQuery.ajax({
            url: 'crm/accident/sendData/' + accident_id,
            type: 'GET',
            beforeSend: function () {
                $('.uploadD').addClass('hidden');
                $('.loading2').removeClass('hidden');
            },
            complete: function () {
                $('.uploadD').removeClass('hidden');
                $('.loading2').addClass('hidden');
            },
            success: function (data) {
                if (!data.error) {
                    toasterMessage("success", data.message, "Uploaded Successfully");
                    //$('#msg').html("<div class='alert alert-success fade show  msg_msg' role='alert'><div class='alert-icon'><i class='flaticon-warning'></i></div><div class='alert-text' id='msg'>"+ data.message+"</div> <div class='alert-close'> <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'><i class='la la-close'></i></span> </button> </div> </div>");
                    $('#msg').html('<div class="alert alert-success alert-dismissible " role="alert">' + data.message + ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
                    $('.loading2').addClass('hidden');
                } else
                    toasterMessage("error", data.message, "Upload Failed");

            },


        });
    });
    jQuery(document).on('click', '.emailModal', function () {
        var patient_id = jQuery(this).attr('data-id');
        var accident_id = jQuery('#accident_id').val();


        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).find('.modal-body').html('');
        jQuery('#' + target).modal('show');
        jQuery('.modal-body').load('crm/accident/email/' + accident_id + '?patient_id=' + patient_id);
        return false;
    });


    jQuery(document).on('submit', '#emailForm', function () {
        var thisAction = jQuery(this);
        //  var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/accident/sendEmail",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    toasterMessage("success", data.message, "Sent Successfully");
                },
                error: function (data) {
                    toasterMessage("error", "Error", "Check Error");
                }
            });
        }
        jQuery('#modal-email').modal('hide');
        return false;
    });


///////


    function toasterMessage(type, message, title) {
        toastr[type](message, title);
    }

    window.toasterMessage = toasterMessage;
});