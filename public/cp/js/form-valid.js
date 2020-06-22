
var FormValid = function () {

	var handleInputsValid = function () {
        jQuery('.tinymce-required').each(function() {
            var this_editor = jQuery(this).attr('id');
            var tinymce_length = tinyMCE.get(this_editor).getContent().length;
            if(tinymce_length<=61)
            {
                jQuery(this).parents('.form-group').find('.help-block.error').remove();
                jQuery(this).parents('.form-group').append('<span class="help-block error">This field is required</span>');
                InputErrors = true;
            }
            else
            {
                 jQuery(this).parents('.form-group').find('.help-block.error').remove();
            }
        });
    };

    var handleErrors = function () {
        handleInputsValid();
        return InputErrors;
    };

    var handleValidationForm = function () {
        jQuery(document).on('submit', '.form-valid', function (e) {
            InputErrors = false;
            if (handleErrors() == true) {
                e.preventDefault();
                return false;
            }
        });
    };

	return {
		init: function () {
			handleValidationForm();
        }
	};

}();

jQuery(document).ready(function() {
    
    FormValid.init();

});