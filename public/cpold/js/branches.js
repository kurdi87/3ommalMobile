var branches = function () {

    /*var handleChangeStatus = function () {
        jQuery(document).on('click', '.btn-ustatus', function () {
            var thisclick = jQuery(this);
            bootbox.confirm("Are you sure?", function (result) {
                if (result == true) {
                    if (thisclick.hasClass('ustatus-active')) {
                        thisclick.removeClass('ustatus-active').addClass('ustatus-inactive');
                        thisclick.find('i').removeClass('fa-check-square').addClass('fa-square-o');
                        thisclick.parents('tr').find('.tdstatus.label').removeClass('label-danger').addClass('label-success').text('Active');
                        thisclick.tooltipster('content', 'Inactive');
                    }
                    else {
                        thisclick.removeClass('ustatus-inactive').addClass('ustatus-active');
                        thisclick.find('i').addClass('fa-check-square').removeClass('fa-square-o');
                        thisclick.parents('tr').find('.tdstatus.label').removeClass('label-success').addClass('label-danger').text('Inactive');
                        thisclick.tooltipster('content', 'Active');
                    }
                    Command: toastr["success"]("Status Updated!", "Success");
                }
            });
            return false;
        });
    };*/

    var handleAddContact = function () {
        jQuery(document).on('click', '.btn-addcontact', function () {

            $.get('cp-attar/branch/branch-contact', function (data) {
                jQuery('.addcontact-list-row').append(data);
                ComponentsBootstrapSelect.init();
            });

        });
    };

    var handleDeleteContact = function () {
        jQuery(document).on('click', '.btn-delcontact', function () {
            var thisclick = jQuery(this);
            bootbox.confirm("Are you sure?", function (result) {
                if (result == true) {
                    thisclick.parents('.addcontact-info').remove();
                    Command: toastr["success"]("Contact Info Deleted!", "Success");
                }
            });
            return false;
        });
    };

    var handleBtnClear = function () {
        jQuery(document).on('click', '.cleardate', function () {
            jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val('');
            jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            input_wlbl();
            return false;
        });
    };

    var handleInputDate = function () {
        jQuery(document).on('change', '.inputdateclear', function () {
            if (jQuery(this).parents('.inputdate-wicon').find('.inputdateclear').val()) {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').removeClass('display-none');
            }
            else {
                jQuery(this).parents('.inputdate-wicon').find('.cleardate').addClass('display-none');
            }
        });
    };

    var default_language = $('.language_switch').data('lang');
    var number_error = 0;
    var handleSwitchLanguage = function () {
        $('.nav-lang>li[data-toggle="tab"]').on('show.bs.tab', function (e) {
            default_language = $(e.target).data("lang");

            jQuery('.input-lang').each(function () {
                var thisval = jQuery(this).parents('.form-group').find('input[lang="' + default_language + '"][type="hidden"]').val();
                jQuery(this).val(thisval);
            });

            input_wlbl();

            handleTabValid();
            handleInputsValid();
        });
    };

    var handleLanguageFields = function () {

        jQuery(document).on('keyup', '.input-lang', function (e) {
            var thisval = jQuery(this).val();
            jQuery(this).parents('.form-group').find('input[lang="' + default_language + '"][type="hidden"]').val(thisval);
        });
    };

    var handleTabValid = function () {
        var numberEn = 0;
        var numberAr = 0;
        number_error = 0;
        jQuery('.input-required ~ input[type=hidden][lang=en]').each(function () {
            if (!jQuery(this).val()) {
                numberEn++;
                number_error++;
            }
        });
        jQuery('.input-required ~ input[type=hidden][lang=ar]').each(function () {
            if (!jQuery(this).val()) {
                numberAr++;
                number_error++;
            }
        });

        jQuery('.input-single').each(function () {
            if (!jQuery(this).val()) {
                numberEn++;
                number_error++;
            }
        });
        jQuery('.inputhdn-single').each(function () {
            if (!jQuery(this).val()) {
                numberEn++;
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
        
        jQuery('.txtinput-filter-lat').each(function () {
            //var latlng_reg = /^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/;
            //var latlng_reg = /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/;
            var lat_reg = /^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/;
            if (jQuery(this).val() && (lat_reg.test(jQuery(this).val().trim()) == false))
            {
                number_error++;
            }
        });

        jQuery('.txtinput-filter-lng').each(function () {
            var lng_reg = /^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/;
            if (jQuery(this).val() && (lng_reg.test(jQuery(this).val().trim()) == false))
            {
                number_error++;
            }
        });


        jQuery('.txtinput-mobilenumber').each(function () {
            //var reg_mobile = /^\+(?:[0-9] ?){6,14}[0-9]$/;
            var reg_mobile = /^[+]?\d{6,14}[0-9]$/;
            var thisclick = jQuery(this);
            var OK = reg_mobile.exec(thisclick.val());
            if ((!OK))
            {
                thisclick.parents('.addcontact-data').find('.txtmobilenumber').html('').text("This is not international phone number");
                thisclick.addClass('has-error');
                number_error++;
            }
            else
            {
                thisclick.parents('.addcontact-data').find('.txtmobilenumber').text("");
                thisclick.removeClass('has-error');
            }
        });

        if (numberEn != 0) {
            jQuery('.nav-lang>li').eq(0).addClass('tab-error');
        }
        else {
            jQuery('.nav-lang>li').eq(0).removeClass('tab-error');
        }
        if (numberAr != 0) {
            jQuery('.nav-lang>li').eq(1).addClass('tab-error');
        }
        else {
            jQuery('.nav-lang>li').eq(1).removeClass('tab-error');
        }
    };

    var InputErrors = false;
    var handleInputsValid = function () {

        jQuery('.input-required ~ input[type=hidden][lang="en"]').each(function () {//'+ default_language +'
            if (!jQuery(this).val()) {
                if (default_language == "en") {
                    jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                }
                InputErrors = true;
            }
            else {
                if (default_language == "en") {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery('.input-required ~ input[type=hidden][lang="ar"]').each(function () {
            if (!jQuery(this).val()) {
                if (default_language == "ar") {
                    jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                }
                InputErrors = true;
            }
            else {
                if (default_language == "ar") {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery('.input-single').each(function () {
            if (!jQuery(this).val()) {
                jQuery(this).addClass('has-error');
                InputErrors = true;
            }
            else {
                jQuery(this).removeClass('has-error');
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

        jQuery('.inputhdn-single').each(function () {
            if (!jQuery(this).val()) {
                jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                InputErrors = true;
            }
            else {
                jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
            }
        });

        jQuery('.txtinput-filter-lat').each(function () {
            //var latlng_reg = /^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/;
            //var latlng_reg = /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/;
            var lat_reg = /^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/;
            if (jQuery(this).val() && (lat_reg.test(jQuery(this).val().trim()) == false))
            {
                jQuery(this).parents('.form-group').addClass('has-error');
                InputErrors = true;
            }
            else
            {
                jQuery(this).parents('.form-group').removeClass('has-error');
            }
        });

        jQuery('.txtinput-filter-lng').each(function () {
            var lng_reg = /^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/;
            if (jQuery(this).val() && (lng_reg.test(jQuery(this).val().trim()) == false))
            {
                jQuery(this).parents('.form-group').addClass('has-error');
                InputErrors = true;
            }
            else
            {
                jQuery(this).parents('.form-group').removeClass('has-error');
            }
        });

        jQuery(document).on('keyup', '.input-required,.input-single,.inputhdn-required', function () {
            if ((jQuery(this).val().trim().length >= 2)) {
                jQuery(this).removeClass('has-error');
            }
            else {
                jQuery(this).addClass('has-error');
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

        jQuery('.txtinput-mobilenumber').each(function () {
            //var reg_mobile = /^\+(?:[0-9] ?){6,14}[0-9]$/;
            var reg_mobile = /^[+]?\d{6,14}[0-9]$/;
            var thisclick = jQuery(this);
            var OK = reg_mobile.exec(thisclick.val());
            if ((!OK))
            {
                thisclick.parents('.addcontact-data').find('.txtmobilenumber').html('').text("This is not international phone number");
                thisclick.addClass('has-error');
                InputErrors = true;
            }
            else
            {
                thisclick.parents('.addcontact-data').find('.txtmobilenumber').text("");
                thisclick.removeClass('has-error');
            }
        });
    };

    var handleErrors = function () {
        handleTabValid();
        handleInputsValid();
        return InputErrors;
    };

    var handleValidationForm = function () {
        jQuery('.form-nosubmit').on('keyup keypress', function (e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                e.preventDefault();
                return false;
            }
        });

        /*jQuery(document).on('click', '#publish-submit', function (e) {
            InputErrors = false;
            if (handleErrors() == true) {
                e.preventDefault();
                return false;
            }
        });*/
    };

    var handleSave = function () {
        $('#save-close-btn').click(function (e) {
            e.preventDefault();

            InputErrors = false;
            number_error = 0;
            if (handleErrors() == true) {
                Command: toastr["error"]("Number of erros "+number_error+"", "Message");
                return false;
            }
            handleStakeholder(function (xhr) {
                if (xhr.status == 200) {
                    var obj = JSON.parse(xhr.responseText);

                    toastr.options.positionClass = "toast-top-right";
                    toastr.success(obj.Response_MSG);

                    setTimeout(function () {
                        window.location.href = "cp-attar/branch";
                    }, 750);
                }
                else {
                    var obj = JSON.parse(xhr.responseText);

                    toastr.options.positionClass = "toast-top-right";
                    toastr.error(obj.Response_MSG);
                }
            });
        });

        $('#save-new-btn').click(function (e) {
            e.preventDefault();
			InputErrors = false;
            number_error = 0;
            if (handleErrors() == true) {
                Command: toastr["error"]("Number of erros "+number_error+"", "Message");
                return false;
            }
            handleStakeholder(function (xhr) {
                if (xhr.status == 200) {
                    var obj = JSON.parse(xhr.responseText);

                    toastr.options.positionClass = "toast-top-right";
                    toastr.success(obj.Response_MSG);

                    setTimeout(function () {
                        window.location.href = "cp-attar/branch/add";
                    }, 750);
                }
                else {
                    var obj = JSON.parse(xhr.responseText);

                    toastr.options.positionClass = "toast-top-right";
                    toastr.error(obj.Response_MSG);
                }
            });
        });
    };

    var handleMobileNumber = function() {
        //var reg_mobile = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        //var reg_mobile = /^\+(?:[0-9] ?){6,14}[0-9]$/;
        var reg_mobile = /^[+]?\d{6,14}[0-9]$/;
        jQuery(document).on('keyup keypress', '.txtinput-mobilenumber', function(e) {
            /*if (jQuery(this).val().trim().length > 0 && reg_mobile.test(jQuery(this).val().trim()) == false) {
            }*/
            var thisclick = jQuery(this);
            var OK = reg_mobile.exec(thisclick.val());
            if (!OK)
            {
                thisclick.parents('.addcontact-data').find('.txtmobilenumber').html('').text("This is not international phone numberd");
                thisclick.addClass('has-error');
            }
            else
            {
                thisclick.parents('.addcontact-data').find('.txtmobilenumber').html('').text("");
                thisclick.removeClass('has-error');
            }
        });
    };

    var handleSelectBranchContact = function() {
        jQuery(document).on('change', 'select.select-contactbranch',function(e) {
            var thisclick = jQuery(this);
            var optionSelected = $("option:selected", this);
            var optionClass = optionSelected.attr('data-myclass');
            thisclick.parents('.addcontact-data').find('input[type="text"].form-control').removeClass('txtinput-filter-number txtinput-mobilenumber').addClass(optionClass);
        });
        jQuery('select.select-contactbranch').change();
    };

    function handleStakeholder(callback) {
        var form = document.getElementById('branch_form');
        var formAction = form.getAttribute('action');
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', formAction, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                return callback(xhr);
            }
        };
        xhr.send(formData);
    }

    return {
        init: function () {
            handleBtnClear();
            handleInputDate();
            handleSave();
            //handleChangeStatus();
            handleAddContact();
            handleDeleteContact();
            handleSwitchLanguage();
            handleLanguageFields();
            handleValidationForm();
            handleSelectBranchContact();
            handleMobileNumber();
        }
    };

}();

jQuery(document).ready(function () {
    branches.init();
});