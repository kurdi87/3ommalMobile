jQuery(document).ready(function () {
    var flag = true;

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });


    jQuery(document).on('change', '.patient', function () {
        window.location = 'crm/gop/create?patient_id=' + this.value
    });
    jQuery(document).on('change', '.totalcostpro', function () {
        var totalcostmed = jQuery(this).parents('.form-package').find('.totalcostmed').val();
        var totalcostpro = jQuery(this).val();
        if (totalcostmed == '')
            totalcostmed = 0;
        var totalcost = parseFloat(totalcostmed) + parseFloat(totalcostpro);
        jQuery(this).parents('.form-package').find('.amount').attr('value', totalcost);
        return false;
    });
    jQuery(document).on('change', '.totalcostmed', function () {
        var totalcostpro = jQuery(this).parents('.form-package').find('.totalcostpro').val();
        var totalcostmed = jQuery(this).val();
        if (totalcostpro == '')
            totalcostpro = 0;
        var totalcost = parseFloat(totalcostmed) + parseFloat(totalcostpro);
        jQuery(this).parents('.form-package').find('.amount').attr('value', totalcost);
        return false;
    });

///////


    function toasterMessage(type, message, title) {
        toastr[type](message, title);
    }

    window.toasterMessage = toasterMessage;
});