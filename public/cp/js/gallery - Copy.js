// JavaScript Document

var Gallery = function () {
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	//var default_language = $('.language_switch.active').data('lang');
	var default_language = $('.language_switch').data('lang');
	
	var handleSwitchLanguage = function() {
		$('.nav-lang>li[data-toggle="tab"]').on('show.bs.tab', function (e) {
			default_language = $(e.target).data("lang");
			
			var gallery_title = $('input[name^="gallery_title"][lang="'+ default_language +'"][type="hidden"]').val();
			var gallery_sub_title = $('input[name^="gallery_sub_title"][lang="'+ default_language +'"][type="hidden"]').val();
			
			$('.gallery-item').each(function(index, element) {
				$(element).find('input[type="text"]').val($(element).find('input[type="text"]').parent('.form-group').find('input[lang="' + default_language + '"]').attr('value'));
				$(element).find('textarea').val($(element).find('textarea').parent('.form-group').find('input[lang="' + default_language + '"]').attr('value'));
            });
			
			$('#gallery_title').val(gallery_title);
			$('#gallery_sub_title').val(gallery_sub_title);

			gtab_validation();
			input_wlbl();
		});
    };

	function gtab_validation() {
		//var tablang = jQuery('.language_switch.active').attr('data-lang');
		jQuery('.input-required ~ input[type=hidden][lang=en]').each(function() {
            if(!jQuery(this).val())
            {
            	if(default_language == "en")
            	{
            		jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
            	}
            }
            else
            {
            	if(default_language == "en")
            	{
            		jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
            	}
            }
        });

        jQuery('.input-required ~ input[type=hidden][lang=ar]').each(function() {
            if(!jQuery(this).val())
            {
            	if(default_language == "ar")
            	{
            		jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
            	}
            }
            else
            {
            	if(default_language == "ar")
            	{
            		jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
            	}
            }
        });

        jQuery('.input-subtitle ~ input[type=hidden][lang=en]').each(function() {
            if(jQuery(this).val()) {
            	if(!jQuery(this).parents('.form-group').find('input[type=hidden][lang=ar]').val())
            	{
            		if(default_language == "ar")
            		{
            			jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
            		}
            		else
            		{
            			jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
            		}
            	}
            }
        });

        jQuery('.input-subtitle ~ input[type=hidden][lang=ar]').each(function() {
        	if(jQuery(this).val()) {
            	if(!jQuery(this).parents('.form-group').find('input[type=hidden][lang=en]').val())
            	{
            		if(default_language == "en")
            		{
            			jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
            		}
            		else
            		{
            			jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
            		}
            	}
            }
        });
	}

	jQuery(document).on('keyup','.input-required',function(){
        if ((jQuery(this).val().trim().length >= 2)) {
            jQuery(this).removeClass('has-error');
        }
        else {
            jQuery(this).addClass('has-error');
        }
    });
	
	var handleLanguageFields = function() {
		
		$(document).ready(function(e) {
			// get values form hidden fields into text box
            $('input[name="gallery_title_' + default_language +'"][lang="' + default_language + '"]').each(function(index, element) {
                $('#gallery_title').val($(element).val());
            });
			input_wlbl();
        });
		
		$('#gallery_title').change(function(e) {
			$('input[name^="gallery_title"][lang="'+ default_language +'"][type="hidden"]').val($(this).val());
        });
		
		$('#gallery_sub_title').change(function(e) {
			$('input[name^="gallery_sub_title"][lang="'+ default_language +'"][type="hidden"]').val($(this).val());
        });
		
		$(document).on('keyup','input[id^="gallery_item_title_"]',function(e) {
			$(this).parent().find('input[type="hidden"][lang="' + default_language + '"]').attr('value',$(this).val());
		});
		
		$(document).on('keyup','textarea[id^="gallery_item_description_"]',function(e) {
			$(this).parent().find('input[type="hidden"][lang="' + default_language + '"]').attr('value',$(this).val());
		});
    };
	
	var handleAddVideoLink = function() {
		$(document).on('click','.btn-addlink', function(event) {
			var thisclick = $(this);
			var gallery_id = $('input[type="hidden"][id="Gall_ID"]').val();
			var text = thisclick.parents('.input-wbtn').find('.youtube-links').val().trim();
			
			jQuery.ajax({
                type: 'POST',
                url: 'cp-attar/gallery/add-video-item',
				data: { query : text, gallery_id : gallery_id },
                dataType: 'html',
                success: function (data) {
                    var youtubeReg = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
					
					if(thisclick.parents('.input-wbtn').find('.youtube-links').val().trim())
					{   
						var link = "http://www.youtube.com/watch?v="+text+"";
						thisclick.parents('.col-md-6').find('.msg').remove();
						
						if(youtubeReg.test(link) == true)
						{
							if(jQuery('.gallery-list>[id="'+text+'"]').size()==0)
							{
								jQuery('.gallery-row').prepend(data);
								thisclick.parents('.input-wbtn').find('.youtube-links').val('');
								//Command: toastr["success"]("Video Added Successfully", "");
								thisclick.parents('.form-group').after('<div class="msg msg-success">Video Added Successfully</div>');
								setTimeout(function(){
									thisclick.parents('.col-md-6').find('.msg').remove();
								},3000);
								gallery_sortable();
								App.init();
								ComponentsBootstrapSwitch.init();
							}
							else
							{
								thisclick.parents('.form-group').after('<div class="msg msg-error">This Video was added</div>');
								setTimeout(function(){
									thisclick.parents('.col-md-6').find('.msg').remove();
								},3000);
							}
						}
						else
						{
							thisclick.parents('.form-group').after('<div class="msg msg-error">Video Error</div>');
							setTimeout(function(){
								thisclick.parents('.col-md-6').find('.msg').remove();
							},3000);
						}
					}
					return false;
                }
            });
		});
	};
	
	var handleAddGallery = function() {
		$('form#gallery-form').on('keyup keypress', function(e) {
			var code = e.keyCode || e.which;
			if (code == 13) {
				e.preventDefault();
				return false;
			}
		});
		
		$(document).on('click', '#draft-submit',function(e) {
			e.preventDefault();
			var Gall_ID = $('input[name="Gall_ID"]').val();
			var formData = $( "form#gallery-form" ).serialize();
			
            jQuery.ajax({
				type: 'POST',
				url: 'cp-attar/gallery/edit/'+ Gall_ID,
				data: formData + '&Gall_Status=GALLERY_STATUS_DRAFT',
				dataType: 'json',
				success: function (data) {
					window.location.href = "cp-attar/gallery";
					//toastr.options.positionClass = "toast-top-right";
					//toastr.success("Draft Saved Successfuly");
				}
			});
        });

        function gallery_validation() {
	        var numberEn = 0;
	        var numberAr = 0;
	        jQuery('.input-required ~ input[type=hidden][lang=en]').each(function() {
	            if(!jQuery(this).val())
	            {
	                numberEn++;
	            }
	        });
	        jQuery('.input-required ~ input[type=hidden][lang=ar]').each(function() {
	            if(!jQuery(this).val())
	            {
	                numberAr++;
	            }
	        });
	        
	        jQuery('.input-subtitle ~ input[type=hidden][lang=en]').each(function() {
	            if(jQuery(this).val()) {
	            	if(!jQuery(this).parents('.form-group').find('input[type=hidden][lang=ar]').val())
	            	{
	            		numberAr++;
	            	}
	            }
	        });

	        jQuery('.input-subtitle ~ input[type=hidden][lang=ar]').each(function() {
	        	if(jQuery(this).val()) {
	            	if(!jQuery(this).parents('.form-group').find('input[type=hidden][lang=en]').val())
	            	{
	            		numberEn++;
	            	}
	            }
	        });

	        //alert(numberEn+','+numberAr);
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
	    }
		
		$(document).on('click', '#publish-submit', function (e) {
			e.preventDefault();
			var Gall_ID = $('input[name="Gall_ID"]').val();
			var formData = $( "form#gallery-form" ).serialize();
			
            jQuery.ajax({
				type: 'POST',
				url: 'cp-attar/gallery/edit/'+ Gall_ID,
				data: formData + '&Gall_Status=GALLERY_STATUS_PUBLISH',
				dataType: 'json',
				beforeSend: function() {
					gallery_validation();
					gtab_validation();
				},
				success: function (data) {
					window.location.href = "cp-attar/gallery";
				},
				error: function (xhr, status, error) {
					toastr.options.positionClass = "toast-top-right";
					toastr.warning(JSON.parse(xhr.responseText));
				}
			});
        });
	};
	
	var handlerRemoveGalleryItem = function() {
		$(document).on('click', '.remove-video, .remove-img', function (e) {
			var portlet = $(this).parents('.portlet').eq(0);
			var GallMed_ID = $(portlet).find('input[name^="gallery_item"][name$="[GallMed_ID]"]').val();

			jQuery.ajax({
				type: 'POST',
				url: 'cp-attar/gallery/remove-media',
				data: {GallMed_ID : GallMed_ID},
				dataType: 'json',
				success: function (data) {
					toastr.options.positionClass = "toast-top-right";
					toastr.success(data);
					jQuery(portlet).parents('.col-md-4').remove();
				},
				error: function (xhr, status, error) {
					toastr.options.positionClass = "toast-top-right";
					toastr.warning(JSON.parse(xhr.responseText));
				}
			});
		});
		
	};
	
	return {
		init: function () {
			handleAddGallery();
			handleAddVideoLink();
			handleLanguageFields();
			handleSwitchLanguage();
			handlerRemoveGalleryItem();
        }
	};
}();

$(document).ready(function() {
	Gallery.init();	
});