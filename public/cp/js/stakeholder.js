
var stakeholder = function () {
	
    var InputErrors = false;
	var base_url = $('base').attr('href');
	var default_language = $('.language_switch').data('lang');
    //var urlreg = /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
    var urlreg = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	
	var handleInputDate = function() {
		jQuery(document).on('change','.inputdateclear',function() {
	    	if(jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val())
	    	{
	    		jQuery(this).parents('.inputdate-wicon').find('.cleardate').removeClass('display-none');
	    	}
	    	else
	    	{
	    		jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
	    	}
	    });
	};
	
    var handleSwitchLanguage = function() {
		$('.nav-lang>li[data-toggle="tab"]').on('show.bs.tab', function (e) {
			default_language = $(e.target).data("lang");

			jQuery('.input-lang').each(function() {
				var thisval = jQuery(this).parents('.form-group').find('input[lang="'+ default_language +'"][type="hidden"]').val();
				jQuery(this).val(thisval);
			});

			input_wlbl();

			handleTabValid();
    		handleInputsValid();
		});
    };

    var handleLanguageFields = function() {
		jQuery(document).on('keyup','.input-lang',function(e) {
			var thisval = jQuery(this).val().trim();
			jQuery(this).parents('.form-group').find('input[lang="'+ default_language +'"][type="hidden"]').val(thisval);
		});
    };

    var number_error = 0;
    var handleTabValid = function() {
        var numberEn = 0;
        var numberAr = 0;
        jQuery('.input-required ~ input[type=hidden][lang=en]').each(function() {
            if(!jQuery(this).val())
            {
                numberEn++;
                number_error++;
            }
        });
        jQuery('.input-required ~ input[type=hidden][lang=ar]').each(function() {
            if(!jQuery(this).val())
            {
                numberAr++;
                number_error++;
            }
        });
        jQuery('select.select-required').each(function() {
        	if(!jQuery(this).val())
        	{
        		numberEn++;
                number_error++;
        	}
        });
        jQuery('.fileimg-required').each(function() {
			if(!jQuery(this).val())
			{
				numberEn++;
                number_error++;
			}
		});
		jQuery('.input-url').each(function () {
            if((jQuery(this).val().trim().length >= 1) && (urlreg.test(jQuery(this).val().trim()) == false))
            {
            	numberEn++;
                number_error++;
        	}
        });

        jQuery('.input-onelang ~ input[type=hidden][lang=en]').each(function () {
            if (jQuery(this).val()) {
                if (!jQuery(this).parents('.form-group').find('input[type=hidden][lang=ar]').val()) {
                    if (default_language == "ar") {
                        jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                    }
                    numberAr++;
                    number_error++;
                }
                else {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery('.input-onelang ~ input[type=hidden][lang=ar]').each(function () {
            if (jQuery(this).val()) {
                if (!jQuery(this).parents('.form-group').find('input[type=hidden][lang=en]').val()) {
                    if (default_language == "en") {
                        jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                    }
                    numberEn++;
                    number_error++;
                }
                else {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        if(numberEn != 0)
        {
        	jQuery('.nav-lang>li').eq(0).addClass('tab-error');
        }
        else
        {
        	jQuery('.nav-lang>li').eq(0).removeClass('tab-error');
        }
        if(numberAr != 0)
        {
        	jQuery('.nav-lang>li').eq(1).addClass('tab-error');
        }
        else
        {
        	jQuery('.nav-lang>li').eq(1).removeClass('tab-error');
        }
    };

    var handleInputsValid = function() {
        
        jQuery('.input-required ~ input[type=hidden][lang="en"]').each(function() {//'+ default_language +'
            if(!jQuery(this).val())
            {
                if(default_language == "en")
                {
                    jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                }
                InputErrors = true;
            }
            else
            {
                if(default_language == "en")
                {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery('.input-required ~ input[type=hidden][lang="ar"]').each(function() {
            if(!jQuery(this).val())
            {
                if(default_language == "ar")
                {
                    jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                }
                InputErrors = true;
            }
            else
            {
                if(default_language == "ar")
                {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery('select.select-required').each(function() {
            if(!jQuery(this).val())
            {
                jQuery(this).parents('.form-group').addClass('has-error');
                InputErrors = true;
            }
            else
            {
                jQuery(this).parents('.form-group').removeClass('has-error');
            }
        });

        jQuery('.fileimg-required').each(function() {
            if(jQuery(this).val())
            {
                jQuery(this).parents('.uploadimg-rg').find('.help-block').remove();
            }
            else
            {
                jQuery(this).parents('.uploadimg-rg').find('.help-block').remove();
                jQuery(this).parents('.uploadimg-rg').append('<span class="help-block error">The Image is required</span>');
                InputErrors = true;
            }
        });

        jQuery('.input-onelang ~ input[type=hidden][lang=en]').each(function () {
            if (jQuery(this).val()) {
                if (!jQuery(this).parents('.form-group').find('input[type=hidden][lang=ar]').val()) {
                    if (default_language == "ar") {
                        jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                    }
                    InputErrors = true;
                }
                else {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery('.input-onelang ~ input[type=hidden][lang=ar]').each(function () {
            if (jQuery(this).val()) {
                if (!jQuery(this).parents('.form-group').find('input[type=hidden][lang=en]').val()) {
                    if (default_language == "en") {
                        jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                    }
                    InputErrors = true;
                }
                else {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery(document).on('change','select.select-required',function() {
            if(!jQuery(this).val())
            {
                jQuery(this).parents('.form-group').addClass('has-error');
                InputErrors = true;
            }
            else
            {
                jQuery(this).parents('.form-group').removeClass('has-error');
            }
        });

        jQuery('.input-url').each(function () {
            if(jQuery(this).val().trim().length >= 1)
            {
                if(urlreg.test(jQuery(this).val().trim()) == true)
                {
                    jQuery(this).removeClass('has-error');
                    jQuery(this).parents('.form-group').find('.help-block').remove();
                }
                else
                {
                    jQuery(this).addClass('has-error');
                    jQuery(this).parents('.form-group').find('.help-block').remove();
                    jQuery(this).parents('.form-group').append('<span class="help-block error">Please enter valid URL</span>');
                    InputErrors = true;
                }
            }
        });
    };

    var handleErrors = function() {
        handleTabValid();
        handleInputsValid();
        return InputErrors;
    };

    var handleValidationForm = function() {

        jQuery(document).on('keyup','.input-required',function(){
            if ((jQuery(this).val().trim().length >= 2)) {
                jQuery(this).removeClass('has-error');
            }
            else {
                jQuery(this).addClass('has-error');
            }
        });

        jQuery(document).on('keyup','.input-url',function(){
            if (jQuery(this).val().trim().length >= 1)
            {
                jQuery(this).addClass('has-error');
                jQuery(this).parents('.form-group').find('.help-block').remove();
                jQuery(this).parents('.form-group').append('<span class="help-block error">Please enter valid URL</span>');
            }
            if (((jQuery(this).val().trim().length > 2) && (urlreg.test(jQuery(this).val().trim()) == true)) || (jQuery(this).val().trim().length == 0))
            {
                jQuery(this).removeClass('has-error');
                jQuery(this).parents('.form-group').find('.help-block').remove();
            }
        });
        
        jQuery('.form-nosubmit').on('keyup keypress', function(e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                e.preventDefault();
                return false;
            }
        });

        /*jQuery(document).on('click', '#save-new-btn', function (e) {
            e.preventDefault();
            InputErrors = false;
			if(handleErrors() == true)
            {
                e.preventDefault();
                return false;
            }
			else
			{
				var data = $('form').serialize();
				
				jQuery.ajax({
					type: 'POST',
					url: base_url + 'cp-attar/stakeholder/add',
					data: data,
					beforeSend: function() {
						
					},
					dataType: 'json',
					success: function (data) {
						console.log(data);
					},
					error: function() {
						//window.location.href = "cp-attar/stakeholder/edit/" + stakeholder_id;
					}
				});
			}
        });*/
		
		/*jQuery(document).on('click', '#save-close-btn', function (e) {
            InputErrors = false;
            if(handleErrors() == true)
            {
                e.preventDefault();
                return false;
            }
			else
			{
				jQuery.ajax({
					type: 'POST',
					url: href,
					data: {},
					beforeSend: function() {
						
					},
					dataType: 'json',
					success: function (data) {
						oTable.draw(false);
						
						toastr.options.positionClass = "toast-top-right";
						toastr.success(data);
					},
					error: function() {
						window.location.href = "cp-attar/stakeholder/edit/" + stakeholder_id;
					}
				});
			}
        });*/
		
		function ajax(url, data)
		{
			
		}
    };

    var handleSelectStakeholderChange = function() {
        jQuery(document).on('change','select.select-stakeholder',function() {
            if(jQuery(this).val() == $('#stakeholder-type').val())
            {
                jQuery('.client-testimonials').collapse('show')
            }
            else
            {
                jQuery('.client-testimonials').collapse('hide')
            }
        });
    };
	
	var handleSave = function() {
		$('#save-close-btn').click(function(e) {
			e.preventDefault();
			InputErrors = false;
            number_error = 0;
            if(handleErrors() == true)
            {
                Command: toastr["error"]("Number of errors "+number_error+"", "Message");
                return false;
            }
            else
            {
    			handleStakeholder(function (xhr) {
    				if (xhr.status == 200) {
    					var obj = JSON.parse(xhr.responseText);
    					
    					toastr.options.positionClass = "toast-top-right";
    					toastr.success(obj.Response_MSG);
    					
    					setTimeout(function(){
    						window.location.href = "cp-attar/stakeholder";
    					}, 750);
    				} 
    				else 
    				{
    					var obj = JSON.parse(xhr.responseText);
    					
    					toastr.options.positionClass = "toast-top-right";
    					toastr.error(obj.Response_MSG);
    				}
    			});
            }
		});
		
		$('#save-new-btn').click(function(e) {
			e.preventDefault();
			InputErrors = false;
            number_error = 0;
            if(handleErrors() == true)
            {
                Command: toastr["error"]("Number of errors "+number_error+"", "Message");
                return false;
            }
            else
            {
    			handleStakeholder(function (xhr) {
    				if (xhr.status == 200) {
    					var obj = JSON.parse(xhr.responseText);
    					
    					toastr.options.positionClass = "toast-top-right";
    					toastr.success(obj.Response_MSG);
    					
    					setTimeout(function(){
    						window.location.href = "cp-attar/stakeholder/add";
    					}, 750);
    				} 
    				else 
    				{
    					var obj = JSON.parse(xhr.responseText);
    					
    					toastr.options.positionClass = "toast-top-right";
    					toastr.error(obj.Response_MSG);
    				}
    			});
            }
		});
	};
	
	function handleStakeholder(callback)
	{
		var form = document.getElementById('stakeholder_form');
		var formAction = form.getAttribute('action');
		var formData = new FormData(form);
		
		var logoFileInput = document.getElementById('stakeholder_logo');
		var logoFile = logoFileInput.files[0];
		formData.append('stakeholder_logo', logoFile);
		
		var imageFileInput = document.getElementById('stakeholder_image');
		var imageFile = imageFileInput.files[0];
		formData.append('stakeholder_image', imageFile);
		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', formAction, true);
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4) {
				return callback(xhr);
			}
		};
		xhr.send(formData);
	}

	return {
		init: function () {
			handleSave();
			handleInputDate();
			handleSwitchLanguage();
			handleLanguageFields();
			handleSelectStakeholderChange();
			handleValidationForm();
        }
	};

}();

jQuery(document).ready(function() {
    
    stakeholder.init();

});