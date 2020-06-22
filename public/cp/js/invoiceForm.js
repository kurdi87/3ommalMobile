jQuery(document).ready(function () {
    var flag = true;

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    jQuery(document).on('change', '.commission_perc', function () {
        var approved_cost = jQuery(this).parents('form').find('.approved_cost').val();
        var commission_perc = jQuery(this).val();

        if (approved_cost == '')
            approved_cost = 0;

        var perc = (approved_cost * commission_perc / 100);

        jQuery(this).parents('.row').find('.amount').attr('value', perc);


        return false;
    });



    jQuery(document).on('change', '.approved_cost', function () {
        var commission_perc = jQuery(this).parents('form').find('.commission_perc').val();
        var approved_cost = jQuery(this).val();

        if (approved_cost == '')
            approved_cost = 0;

        var perc = (approved_cost * commission_perc / 100);

        jQuery(this).parents('form').find('.amount').attr('value', perc);


        return false;
    });
    jQuery(document).on('change', '.discountt', function () {
        var approved_cost = jQuery(this).parents('form').find('.start_approved_cost').val();
        var discount = jQuery(this).val();
        var perc = jQuery(this).parents('form').find('.perc').is(':checked');
        if (perc)
            approved_cost = approved_cost - (approved_cost * discount / 100);
        else
            approved_cost = approved_cost -  discount ;
        jQuery(this).parents('form').find('.approved_cost').attr('value', approved_cost);
        jQuery(this).parents('form').find('.approved_cost').val=approved_cost;
        return false;
    });
    jQuery(document).on('change', '.perc', function () {
        var approved_cost = jQuery(this).parents('form').find('.start_approved_cost').val();
        var discount = jQuery(this).parents('form').find('.discountt').val();
        var perc = jQuery(this).parents('form').find('.perc').is(':checked');
        if (perc)
            approved_cost = approved_cost - (approved_cost * discount / 100);
        else
            approved_cost = approved_cost -  discount ;
        jQuery(this).parents('form').find('.approved_cost').attr('value', approved_cost);

        return false;
    });



    $(document).ready(function () {
        $(window).keydown(function (invoice) {
            if (invoice.keyCode == 13) {
                invoice.prinvoiceDefault();
                return false;
            }
        });

    });


    jQuery(document).on('change', '.patient', function () {
        window.location = 'crm/invoice/create?patient_id=' + this.value
    });

///////


    function toasterMessage(type, message, title) {
        toastr[type](message, title);
    }

    window.toasterMessage = toasterMessage;
});