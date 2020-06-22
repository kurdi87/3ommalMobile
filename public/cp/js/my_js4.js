jQuery(document).ready(function () {
    var flag = true;

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.procedurechoose').select2({
        placeholder: 'Select an option',
        dropdownParent: $('#modal-proadd')
    });



    $('.adddestination2').select2({
        placeholder: 'Select an option',
        dropdownParent: $('#modal-RequestsTransactionEdit')
    });

    $('.adddestination').select2({
        placeholder: 'Select an option',
        dropdownParent: $('#modal-RequestsTransactionadd')
    });

    $('.procedurechoose2').select2({
        placeholder: 'Select an option',
        dropdownParent: $('#modal-proadd')
    });

    $('.dieseas_id').select2({
        placeholder: 'Select an option',
        dropdownParent: $('#modal-dieseasadd')
    });

    $('.dept').select2({
        placeholder: 'Select an option',
        dropdownParent: $('#modal-deptadd')
    });
    $('.deptdoct').select2({
        placeholder: 'Select an option',
        dropdownParent: $('#modal-deptadd')
    });
    $('.hospitaladd').select2({
        placeholder: 'Select an option',
        dropdownParent: $('#modal-hospitaladd')
    });


    jQuery(document).on('change','.procedurechoose',function(){
        var cost=$('#hh :selected').attr('cost');
        var qty=jQuery(this).parents('.addpro').find('.qty').val();
        var exchange=jQuery(this).parents('.addpro').find('.exchange').val();
        var totalcost= parseFloat(cost);
        var totaldolar= parseFloat(cost)*parseFloat(qty)/parseFloat(exchange);
        var totalcostnis= parseFloat(cost)*parseFloat(qty);
        jQuery(this).parents('.addpro').find('.cost').attr('value',totalcost);
        jQuery(this).parents('.addpro').find('.dolar').attr('value',totaldolar);
        jQuery(this).parents('.addpro').find('.nis').attr('value',totalcostnis);

    });

    jQuery(document).on('change','.qty',function(){
        var cost=jQuery(this).parents('.addpro').find('.cost').val();
        var qty=jQuery(this).val()
        var totalcost= parseFloat(cost);
        var exchange=jQuery(this).parents('.addpro').find('.exchange').val();
        var totaldolar= parseFloat(cost)*parseFloat(qty)/parseFloat(exchange);
        var totalcostnis= parseFloat(cost)*parseFloat(qty);
        jQuery(this).parents('.addpro').find('.cost').attr('value',totalcost);
        jQuery(this).parents('.addpro').find('.dolar').attr('value',totaldolar);
        jQuery(this).parents('.addpro').find('.nis').attr('value',totalcostnis);

    });
    jQuery(document).on('change','.cost',function(){
        var cost=jQuery(this).val()
        var qty=jQuery(this).parents('.addpro').find('.qty').val();
        var totalcost= parseFloat(cost);
        var exchange=jQuery(this).parents('.addpro').find('.exchange').val();
        var totaldolar= parseFloat(cost)*parseFloat(qty)/parseFloat(exchange);
        var totalcostnis= parseFloat(cost)*parseFloat(qty);
        jQuery(this).parents('.addpro').find('.cost').attr('value',totalcost);
        jQuery(this).parents('.addpro').find('.dolar').attr('value',totaldolar);
        jQuery(this).parents('.addpro').find('.nis').attr('value',totalcostnis);

    });
    jQuery(document).on('change','.exchange',function(){
        var cost=jQuery(this).parents('.addpro').find('.cost').val();
        var qty=jQuery(this).parents('.addpro').find('.qty').val();
        var totalcost= parseFloat(cost);
        var exchange=jQuery(this).val();
        var totaldolar= parseFloat(cost)*parseFloat(qty)/parseFloat(exchange);
        var totalcostnis= parseFloat(cost)*parseFloat(qty);
        jQuery(this).parents('.addpro').find('.cost').attr('value',totalcost);
        jQuery(this).parents('.addpro').find('.dolar').attr('value',totaldolar);
        jQuery(this).parents('.addpro').find('.nis').attr('value',totalcostnis);

    });

    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });





    jQuery(document).on('change', '.upload-profile-img', function () {

        if (flag == true) {
            flag = false;
            var my_file = this.files[0];
            var my_button = jQuery(this);
            var size = parseInt(this.files[0].size);
            size = size / 1024;
            var file = jQuery(this).val();
            var extension = file.substr((file.lastIndexOf('.') + 1)).toLowerCase();
            var type = false;
            if (extension == 'jpg' || extension == 'jpeg' || extension == 'png')
                type = true;

            if (size <= 4096 && type == true) {
                var fd = new FormData();
                fd.append("choose-file", my_file);
                jQuery.ajax({
                    url: 'crm/uploadProfile',
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
                            var src = "uploads/users/" + data.file_name;
                            my_button.parents('.upload-avatar-img').css('background-image', 'url(' + src + ')');
                        }
                        else {
                            flag = true;
                            var message = data.message;
                            toasterMessage("error", message, "Upload Error");
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



    toastr.options = {
        "closeButton": true,
        "debug": true,
        "positionClass": "toast-bottom-right",
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    jQuery(document).on('click','.rem-packageimgfile',function() {
        var thisclick = jQuery(this);
        bootbox.confirm("Are you sure?", function(result) {
            if(result==true)
            {
                thisclick.parents(".upload-image-rg").find('.image-value,.file-img').val('');
                thisclick.parents(".upload-image-rg").removeAttr('style');
                thisclick.remove();
            }
        });
    });

});

$('.idgetdate').datepicker({
    dateFormat: 'yyyy-mm-dd',
    minDate: '+5d',
    changeMonth: true,
    changeYear: true,
    altField: "#idgetdate",
    altFormat: "yyyy-mm-dd"
});

jQuery(document).on('click', '.notification', function () {
    thisclick = jQuery(this);
    var request_id = jQuery(this).attr('request_id');

    jQuery.ajax({
        url: jQuery(this).attr('link'),
        type: 'GET',
        data: {"id[]": thisclick.attr('data-id'), request_id: request_id},
        dataType: "json",
        success: function (data) {

            location.href = "tabibfind/ConsultRequest/edit/"+request_id;


        }

    });

    return false;
});




function toasterMessage(type, message, title) {
    toastr[type](message, title);
}

window.toasterMessage = toasterMessage;