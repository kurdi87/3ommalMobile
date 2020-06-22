
 var errors;

 var tooltip_place = "left";
 
 jQuery(document).ready(function() {

    if(jQuery('body').attr('lang')=="ar")
    {
        tooltip_place = "right";
    }

    //jQuery('[data-toggle="tooltip"]').tooltip();

    //jQuery('[data-toggle="tooltip"]').tooltip('show');

    jQuery(document).on('keydown', '.txtinput-filter-number', function (event) {
         // Allow: backspace, delete, tab, escape, enter and , 190.
         if ($.inArray(event.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
             // Allow: Ctrl+A
             (event.keyCode == 65 && event.ctrlKey == true) ||
             // Allow: home, end, left, right
             (event.keyCode >= 35 && event.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
         }
         else {
             // Ensure that it is a number and stop the keypress
             if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                 event.preventDefault();
             }
         }
    });
     
    jQuery(document).on('keydown', '.txtnotnumber', function (event) {
        if (event.altKey == false && event.ctrlKey == false)
        {
            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) && event.shiftKey== false)
            {
                return false;
            }
            else
            {
                if((event.keyCode >= 65 && event.keyCode <= 90) ||
                (event.keyCode >= 97 && event.keyCode <= 122))
                {}
            }
        }
    });

    var top;
    
    var urlreg = /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
    var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    jQuery(document).on('submit', '.form-validation', function() {
        
        errors = false;

        if(window.innerWidth <=992)
        {
            tooltip_place = "top";
        }

		//--------------------------------------------------

        jQuery(this).find('.txtinput-required').each(function() {
            
            if (jQuery(this).val().trim().length < 1) {
                jQuery(this).addClass('error-required required-field');
                jQuery(this).parent().addClass('error-parent');
                if (jQuery(this).hasClass('login-error')) {
                    jQuery(this).addClass('login-error-gen');
                }
                if (errors == false) {
                    top = jQuery(this).offset().top;
                }
                errors = true;
            }
            else {
                jQuery(this).removeClass('error-required');
                jQuery(this).parent().removeClass('error-parent');
            }
           
        });

        
        jQuery(this).find('.txtinput-url').each(function () {
            if (jQuery(this).val().trim().length < 1) {
                jQuery(this).addClass('error-required required-field');
                jQuery(this).parent().addClass('error-parent');
                if (errors == false) {
                    top = jQuery(this).offset().top;
                }
                errors = true;
            }
            else {
                if ((jQuery(this).val().trim().length >= 1) && urlreg.test(jQuery(this).val().trim()) == true) {
                    jQuery(this).removeClass('error-required');
                    jQuery(this).parent().removeClass('error-parent');
                    jQuery(this).parent().find('.error-msg-validation').remove();
                }
                else {
                    jQuery(this).addClass('error-required');
                    jQuery(this).parent().addClass('error-parent');
                    if (!jQuery(this).parent().find('.error-msg-validation').is(':visible')) {
                        jQuery(this).parent().append('<span class="error-msg-validation">Please enter valid URL</span>');
                    }
                    if (errors == false || (jQuery(this).offset().top < top)) {
                        top = jQuery(this).offset().top;
                    }
                    errors = true;
                }
            }
        });

        jQuery(this).find('.txtinput-email').each(function() {

            if (jQuery(this).val().trim().length > 0 && emailreg.test(jQuery(this).val().trim()) == false) {

                jQuery(this).addClass('error-required');
                jQuery(this).parent().addClass('error-parent');
                if (!jQuery(this).parent().find('.error-msg-validation').is(':visible')) {
                    jQuery(this).parent().append('<span class="error-msg-validation">Please enter valid email</span>');
                }
                if (errors == false || (jQuery(this).offset().top < top)) {
                    top = jQuery(this).offset().top;
                }
                errors = true;
            }
            else if(!jQuery(this).hasClass('required-field')){
                jQuery(this).removeClass('error-required');
                jQuery(this).parent().removeClass('error-parent');
                jQuery(this).parent().find('.error-msg-validation').remove();
            }
            else {
                jQuery(this).parent().find('.error-msg-validation').remove();
            }
        });
		
		//-----------------------------------------------------------------------
		jQuery(this).find('.txtinput-mobile').each(function () {
		    var txtinput_minlength_val = jQuery(this).attr('data-minlength');
		    var str = jQuery(this).val();
		    if (jQuery(this).val().trim().length < 1) {
		        jQuery(this).addClass('error-required required-field');
                jQuery(this).parent().addClass('error-parent');
		        if (errors == false) {
		            top = jQuery(this).offset().top;
		        }
		        errors = true;
		    }
		    else {
		        if ((jQuery(this).val().trim().length >= 10) && (str.substring(0, 2) == '05')) {
		            jQuery(this).removeClass('error-required');
                    jQuery(this).parent().removeClass('error-parent');
		            jQuery(this).parent().find('.error-msg-validation').remove();
                    //jQuery(this).parent().find('[data-toggle="tooltip"]').tooltip('hide').remove();
		        }
		        else {
		            jQuery(this).addClass('error-required');
                    jQuery(this).parent().addClass('error-parent');
		            if (!jQuery(this).parent().find('.error-msg-validation').is(':visible')) {
                        jQuery(this).parent().append('<span class="error-msg-validation">Please enter at least ' + txtinput_minlength_val + ' fields </span>');
    		        }
		            if (errors == false || (jQuery(this).offset().top < top)) {
		                top = jQuery(this).offset().top;
		            }
		            errors = true;
		        }
		    }
		});
        
        jQuery(this).find('.txtinput-minlength').each(function () {
            var txtinput_minlength_val = jQuery(this).attr('data-minlength');
            var str = jQuery(this).val();
            if((jQuery(this).val().trim().length > 0))
            {
                if ((jQuery(this).val().trim().length >= txtinput_minlength_val)) {
                    jQuery(this).removeClass('error-required');
                    jQuery(this).parent().removeClass('error-parent');
                    jQuery(this).parent().find('.error-msg-validation').remove();
                }
                else {
                    jQuery(this).addClass('error-required');
                    jQuery(this).parent().addClass('error-parent');
                    if (!jQuery(this).parent().find('.error-msg-validation').is(':visible')) {
                        jQuery(this).parent().append('<span class="error-msg-validation">Please enter at least ' + txtinput_minlength_val + ' fields </span>');
                    }
                    if (errors == false || (jQuery(this).offset().top < top)) {
                        top = jQuery(this).offset().top;
                    }
                    errors = true;
                }
            }
        });
        
        jQuery(this).find('.txtinput-nationalID').each(function () {
            var txtinput_minlength_val = parseInt(jQuery(this).attr('data-minlength'));
            var str = jQuery(this).val();
            if (jQuery(this).val().trim().length < 1) {
                jQuery(this).addClass('error-required required-field');
                jQuery(this).parent().addClass('error-parent');
                if (errors == false) {
                    top = jQuery(this).offset().top;
                }
                errors = true;
            }
            else {
                if (((jQuery(this).val().trim().length >= txtinput_minlength_val) && (str.substring(0, 1) == '1')) || ((jQuery(this).val().trim().length >= txtinput_minlength_val) && (str.substring(0, 1) == '2'))) {
                    jQuery(this).removeClass('error-required');
                    jQuery(this).parent().removeClass('error-parent');
                    jQuery(this).parent().find('.error-msg-validation').remove();
                }
                else {
                    jQuery(this).addClass('error-required');
                    jQuery(this).parent().addClass('error-parent');
                    if (!jQuery(this).parent().find('.error-msg-validation').is(':visible')) {
                        jQuery(this).parent().append('<span class="error-msg-validation">Please enter National ID</span>');
                    }
                    if (errors == false || (jQuery(this).offset().top < top)) {
                        top = jQuery(this).offset().top;
                    }
                    errors = true;
                }
            }
        });
        
        jQuery(this).find('.txtinput-related').each(function() {

            var input_related = jQuery(this).attr('data-related');
            var input_related_val = jQuery(this).parents('form').find('input[name='+input_related+']').val();
            var this_input_val = jQuery(this).val();
            var this_input_placeholder = jQuery(this).parents('form').find('input[name='+input_related+']').attr('placeholder');
            var input_related_placeholder = jQuery(this).attr('placeholder');
            //if (jQuery(this).val().trim().length > 0) {
            if (input_related_val != this_input_val) {
                jQuery(this).addClass('error-required');
                jQuery(this).parent().addClass('error-parent');
                if (!jQuery(this).parent().find('.error-msg-validation').is(':visible')) {
                    jQuery(this).parent().append('<span class="error-msg-validation">'+input_related_placeholder+' and '+this_input_placeholder+' not equal</span>');
                }
                if (errors == false || (jQuery(this).offset().top < top)) {
                    //top = jQuery(this).offset().top;
                    top = jQuery(this).offset().top;
                }
                errors = true;
            }
            else {
                if (jQuery(this).val().trim().length > 0) 
                {
                    jQuery(this).removeClass('error-required');
                    jQuery(this).parent().removeClass('error-parent');
                    jQuery(this).parent().find('.error-msg-validation').remove();
                }
            }
            //}
        });
        
        jQuery(this).find('.select-input .chosen-select>option:selected,.select-input .chosen-select-search>option:selected,.select2-required>option:selected').each(function(){
            if(jQuery(this).val().length>0)
            {
                //jQuery(this).parents('.select-input').find('.select2-container .select2-choice,.select2-container .select2-selection--single').removeClass('select-error');
                jQuery(this).parents('.form-group').removeClass('has-error');
            }
            else
            {
                //jQuery(this).parents('.select-input').find('.select2-container .select2-choice,.select2-container .select2-selection--single').addClass('select-error');
                jQuery(this).parents('.form-group').addClass('has-error');
                errors = true;
            }
        });

        jQuery(this).find('.permissions-row').each(function() {
            var this_elm = jQuery(this);
            if(this_elm.find('.mycheckbox:not(.pcheckbox):checked').length<=0)
            {
                Command: toastr["error"]("Please check at least one permissions!", "Message");
                errors = true;
            }
        });
        
        if (errors == true) {
            if (top) {
                //top = top.offset().top;
                if((jQuery(this).hasClass('bookform')==false))
                {
                    jQuery('html,body').animate({scrollTop: top - 100}, 400);
                }
            }
            return false;
        }
    });
    
    jQuery(document).on('keyup','.txtinput-required',function(){
        if ((jQuery(this).val().trim().length > 2)) {
            jQuery(this).removeClass('error-required required-field');
            jQuery(this).parent().removeClass('error-parent');
        }
        else {
            jQuery(this).addClass('error-required required-field');
            jQuery(this).parent().addClass('error-parent');
        }
    });

    jQuery(document).on('keyup','.txtinput-email',function(){
        if ((jQuery(this).val().trim().length > 2)) {
            jQuery(this).addClass('error-required required-field');
            jQuery(this).parent().addClass('error-parent');
        }
        if ((jQuery(this).val().trim().length > 2) && (emailreg.test(jQuery(this).val().trim()) == true)) {
            jQuery(this).removeClass('error-required required-field');
            jQuery(this).parent().removeClass('error-parent');
            //jQuery(this).parent().find('[data-toggle="tooltip"]').tooltip('hide').remove();
            jQuery(this).parent().find('.error-msg-validation').remove();
        }
    });
    
    jQuery(document).on('keyup','.txtinput-related',function() {
        var input_related = jQuery(this).attr('data-related');
        var input_related_val = jQuery(this).parents('form').find('input[name='+input_related+']').val();
        var this_input_val = jQuery(this).val();
        var this_input_placeholder = jQuery(this).parents('form').find('input[name='+input_related+']').attr('placeholder');
        var input_related_placeholder = jQuery(this).attr('placeholder');
        jQuery(this).parent().find('.success-msg-validation,.error-msg-validation').remove();
        if (input_related_val == this_input_val) {
            jQuery(this).parent().append('<span class="success-msg-validation">Identical Password</span>')
        }
        if (input_related_val != this_input_val) {
            jQuery(this).parent().find('.success-msg-validation,.error-msg-validation').remove();
            jQuery(this).parent().find('.error-msg-validation').remove();
            jQuery(this).parent().append('<span class="error-msg-validation">'+input_related_placeholder+' and '+this_input_placeholder+' not equal</span>');
        }
        else {
            if (jQuery(this).val().trim().length > 0) 
            {
                jQuery(this).removeClass('error-required');
                jQuery(this).parent().removeClass('error-parent');
                jQuery(this).parent().find('.error-msg-validation').remove();
            }
        }
    });
    
    jQuery(document).on('keyup','.myinput-password',function() {
        var this_input = jQuery(this);
        var txtinput_minlength_val = this_input.attr('data-minlength');
        var str = this_input.val();

        var input_related_val = jQuery(this).parents('form').find('.txtinput-related').val();
        var this_input_val = jQuery(this).val();
        var this_input_placeholder = jQuery(this).parents('form').find('.txtinput-related').attr('placeholder');
        var input_related_placeholder = jQuery(this).attr('placeholder');

        if((this_input.val().trim().length > 0))
        {
            if ((this_input.val().trim().length >= txtinput_minlength_val))
            {
                jQuery(this).removeClass('error-required');
                jQuery(this).parent().removeClass('error-parent');
                jQuery(this).parent().find('.error-msg-validation').remove();
                if(jQuery(this).parents('form').find('.txtinput-related').val())
                {
                    jQuery(this).parents('form').find('.txtinput-related').parent().find('.success-msg-validation,.error-msg-validation').remove();
                    jQuery(this).parents('form').find('.txtinput-related').parent().append('<span class="error-msg-validation">'+input_related_placeholder+' and '+this_input_placeholder+' not equal</span>');
                }
            }
            else
            {
                jQuery(this).addClass('error-required');
                jQuery(this).parent().addClass('error-parent');
                jQuery(this).parent().find('.error-msg-validation').remove();
                jQuery(this).parent().append('<span class="error-msg-validation">Please enter at least ' + txtinput_minlength_val + ' fields </span>');
                errors = true;
            }
            if (input_related_val == this_input_val) {
                jQuery(this).parents('form').find('.txtinput-related').parent().find('.success-msg-validation,.error-msg-validation').remove();
                jQuery(this).parents('form').find('.txtinput-related').parent().append('<span class="success-msg-validation">Identical Password</span>')
            }
        }
    });
    
    jQuery('.select-input .chosen-select,.select-input .chosen-select-search,.select2-required').change(function(){
        if(jQuery(this).find('option:selected').val().length>0)
        {
            //jQuery(this).parents('.select-input').find('.select2-container .select2-choice,.select2-container .select2-selection--single').removeClass('select-error');
            jQuery(this).parents('.form-group').removeClass('has-error');
            jQuery(this).parent().find('.error-msg-validation').remove();
        }
    });
    
});