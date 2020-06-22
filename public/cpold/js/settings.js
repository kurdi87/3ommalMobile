jQuery(document).ready(function() {    
    $(".box-permissions").each(function(){
        if(!jQuery(this).find("ul>li").length)
            jQuery(this).parent().remove();
        
    });
 $('.textarea').wysihtml5();
    $("#touchspin_slider").TouchSpin({
        verticalbuttons: true,
        min: 1,
        max: 9,
    });

    jQuery('.input-wcheckbox-rg .systemclose-checkbox').each(function() {
        if(jQuery(this).prop('checked'))
        {
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-closemsg').removeClass('txtinput-required error-required required-field');
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-closemsg-rg').collapse('hide');
        }
        else
        {
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-closemsg').addClass('txtinput-required');
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-closemsg-rg').collapse('show');
        }
    });

    $('.systemclose-checkbox').on('switchChange.bootstrapSwitch', function (event, state) {
        if(state==true)
        {
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-closemsg').removeClass('txtinput-required error-required required-field');
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-closemsg-rg').collapse('hide');
        }
        else
        {
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-closemsg').addClass('txtinput-required');
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-closemsg-rg').collapse('show');
        }
    });

    jQuery('.input-wcheckbox-rg .systemnotify-checkbox').each(function() {
        if(jQuery(this).prop('checked'))
        {
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-notifymsg').addClass('txtinput-required');
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-notifymsg-rg').collapse('show');
        }
        else
        {
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-notifymsg').removeClass('txtinput-required error-required required-field');
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-notifymsg-rg').collapse('hide');
        }
    });

    $('.systemnotify-checkbox').on('switchChange.bootstrapSwitch', function (event, state) {
        if(state==true)
        {
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-notifymsg').addClass('txtinput-required');
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-notifymsg-rg').collapse('show');
        }
        else
        {
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-notifymsg').removeClass('txtinput-required error-required required-field');
            jQuery(this).parents('.input-wcheckbox-rg').find('.input-notifymsg-rg').collapse('hide');
        }
    });

});