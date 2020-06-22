var flag = true;
var articles = function () {
    var default_language = $('.language_switch').data('lang');

    var InputErrors = false;
    var number_error = 0;
    function handleTitle_article_validation() {
        var numberEn = 0;
        number_error = 0;
        jQuery('.inputtitle-required').each(function () {
            if (!jQuery(this).val()) {
                numberEn++;
                InputErrors = true;
                number_error++;
                jQuery(this).addClass('has-error');
            }
            else {
                jQuery(this).removeClass('has-error');
            }
        });
        jQuery('select.selecttype-required').each(function () {
            if (!jQuery(this).val()) {
                jQuery(this).parents('.form-group').addClass('has-error');
                numberEn++;
                InputErrors = true;
                number_error++;
            }
            else {
                jQuery(this).parents('.form-group').removeClass('has-error');
            }
        });

        if (numberEn != 0) {
            jQuery('.nav-lang>li').eq(0).addClass('tab-error');
        }
        else {
            jQuery('.nav-lang>li').eq(0).removeClass('tab-error');
        }
        return InputErrors;
    }

    var handleTabValid = function () {
        var numberEn = 0;
        var numberAr = 0;
        number_error = 0;
        jQuery('.forminputsingle-required').each(function () {
            if (!jQuery(this).val()) {
                numberEn++;
                //number_error++;
            }
        });

        jQuery('.forminput-required[data-lang=en] .form-control').each(function () {
            if (!jQuery(this).val()) {
                numberEn++;
                //number_error++;
            }
        });
        jQuery('.forminput-required[data-lang=ar] .form-control').each(function () {
            if (!jQuery(this).val()) {
                numberAr++;
                //number_error++;
            }
        });
        jQuery('select.select-required').each(function () {
            if (!jQuery(this).val()) {
                numberEn++;
                //number_error++;
            }
        });

        jQuery('#hdn_imgcrop').each(function () {
            if (!jQuery(this).val() && (jQuery(this).attr('data-edit') == false)) {
                numberEn++;
                //number_error++;
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

    var handleInputsValid = function () {

        jQuery('.forminputsingle-required').each(function () {
            if (!jQuery(this).val()) {
                jQuery(this).addClass('has-error');
                InputErrors = true;
                number_error++;
            }
            else {
                jQuery(this).removeClass('has-error');
            }
        });

        jQuery('.forminput-required[data-lang="en"] .form-control').each(function () {//'+ default_language +'
            if (!jQuery(this).val()) {
                if (default_language == "en") {
                    jQuery(this).addClass('has-error');
                }
                jQuery(this).addClass('has-error');
                InputErrors = true;
                number_error++;
            }
            else {
                if (default_language == "en") {
                    jQuery(this).removeClass('has-error');
                }
                jQuery(this).removeClass('has-error');
            }
        });

        jQuery('.forminput-required[data-lang="ar"] .form-control').each(function () {
            if (!jQuery(this).val()) {
                if (default_language == "ar") {
                    jQuery(this).addClass('has-error');
                }
                jQuery(this).addClass('has-error');
                InputErrors = true;
                number_error++;
            }
            else {
                if (default_language == "ar") {
                    jQuery(this).removeClass('has-error');
                }
                jQuery(this).removeClass('has-error');
            }
        });

        jQuery('#hdn_imgcrop').each(function () {
            jQuery(this).parents('.uploadimage-crop-area').find('.help-block.error').remove();
            if ((jQuery(this).attr('data-edit') == "false")) {
                if (!jQuery(this).val()) {
                    InputErrors = true;
                    number_error++;
                    jQuery(this).parents('.uploadimage-crop-rg').after('<span class="help-block error">The Image is required</span>');
                }
            }
        });

        jQuery('select.select-required').each(function () {
            if (!jQuery(this).val()) {
                jQuery(this).parents('.form-group').addClass('has-error');
                InputErrors = true;
                number_error++;
            }
            else {
                jQuery(this).parents('.form-group').removeClass('has-error');
            }
        });

        /*function strip_tags(body)
        {
            var regex = /(<([^>]+)>)/ig
            ,   result = body.replace(regex, "");
            console.log(result);
            return result;
        }*/

        jQuery('.tinymce-required').each(function() {
            var this_editor = jQuery(this).attr('id');
            //var tinymce_content = tinymce.editors(this_editor).getContent();
            //var tinymce_content = jQuery('#'+this_editor).tinymce().getContent();
            /*var tinymce_content = tinyMCE.editors[0].getContent();
            var tinymce_content_val = strip_tags(tinymce_content.trim());
            alert(tinymce_content_val.length);
            if (tinymce_content_val.length>1)
            {
                alert(1);
            }
            else
            {
                alert(2);
            }*/
            var tinymce_length = tinyMCE.get(this_editor).getContent().trim().length;
            if(tinymce_length<=61)
            {
                jQuery(this).parents('.form-group').find('.help-block.error').remove();
                jQuery(this).parents('.form-group').append('<span class="help-block error">This field is required</span>');
                InputErrors = true;
                number_error++;
            }
            else
            {
                jQuery(this).parents('.form-group').find('.help-block.error').remove();
            }
        });

        jQuery(document).on('change', 'select.select-required', function () {
            if (!jQuery(this).val()) {
                jQuery(this).parents('.form-group').addClass('has-error');
                InputErrors = true;
            }
            else {
                jQuery(this).parents('.form-group').removeClass('has-error');
            }
        });

        jQuery(document).on('keyup', '.forminput-required .form-control', function () {
            if ((jQuery(this).val().trim().length >= 2)) {
                jQuery(this).removeClass('has-error');
            }
            else {
                jQuery(this).addClass('has-error');
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

        jQuery(document).on('click', '.publish-submit', function (e) {
            gallery_validation();
            InputErrors = false;
            if (handleErrors() == true) {
                e.preventDefault();
                return false;
            }
        });
    };

    var counter = function (x) {
        var value = $(x).val();

        if (value.length == 0) {
            $(x).parent().find('.wordCount').html(0);
            $(x).parent().find('.totalChars').html(0);
            $(x).parent().find('.charCount').html(0);
            $(x).parent().find('.charCountNoSpace').html(0);
            return;
        }
        var regex = /\s+/gi;
        var wordCount = value.trim().replace(regex, ' ').split(' ').length;
        var totalChars = value.length;
        var charCount = value.trim().length;
        var charCountNoSpace = value.replace(regex, '').length;

        $(x).parent().find('.wordCount').html(wordCount);
        /* count words */
        $(x).parent().find('.totalChars').html(totalChars);
        /* count chars */
        $(x).parent().find('.charCount').html(charCount);
        /* count  chars with space*/
        $(x).parent().find('.charCountNoSpace').html(charCountNoSpace);
        /* count char without space */
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

    var counWordAndCharacter = function () {
        var textArea2 = '.textAreaCount';
        jQuery(document).on('keyup change', textArea2, function () {
            counter(this);
        });

        jQuery(window).load(function () {
            $('.textAreaCount').each(function () {
                counter(this);
            });
        });
    };

    var confirm = function (message, route) {
        toasterMessage("success", message, "Success");
        setTimeout(function () {
            window.top.location = route;
        }, 1000);
    }

    var haveItems = function(){
        return jQuery(".gallery-item").length;
    }

    var saveForm = function (route) {
        jQuery(document).on("click", ".draf-submit", function () {
            /*if(handleTitle_article_validation())
            {
                Command: toastr["error"]("Number of errors "+(parseInt(number_error)+parseInt(gallery_numbererrors()))+"", "Message");
            }*/
        });
        jQuery(document).on("click", ".publish-submit", function () {
            if(handleErrors())
            {
                Command: toastr["error"]("Number of errors "+(parseInt(number_error)+parseInt(gallery_numbererrors()))+"", "Message");
            }
        });
        jQuery(document).on("submit", ".horizontal-form", function () {
            var this_click = jQuery(this);
            var formData = new FormData($(this)[0]);
            var val = $("button[type=submit][clicked=true]").attr("name");

            InputErrors = false;
            var galleryErrors = false;

            if (val == "publishNow") {
                InputErrors = handleErrors();
                galleryErrors = gallery_validation();
                if (!jQuery("#Gall_ID").val()) {
                    formData.append("publish", "true");
                }
                if(galleryErrors)
                {
                    Command: toastr["error"]("Number of errors "+(parseInt(number_error)+parseInt(gallery_numbererrors()))+"", "Message");
                }
            } else {
                galleryErrors = title_validation();
                InputErrors = handleTitle_article_validation();
                if(galleryErrors || InputErrors)
                {
                    Command: toastr["error"]("Number of errors "+(parseInt(number_error)+parseInt(gallery_numbererrors()))+"", "Message");
                }
            }
            if (flag && !InputErrors && !galleryErrors) {
                flag = false;

                if (jQuery("#Gall_ID").val()) {

                    if (val == "publishNow")
                    {
                        flag=true;
                        var msg = 'You can save publish while images uploading';
                        if(jQuery('body').attr('data-lang')=="ar")
                        {
                            msg = 'لا يمكن اجراء عملية الحفظ بينما هناك عناصر قيد الرفع';
                        }
                        if(check_uploading()==true)
                        {
                            jQuery('#modal-uploadingmsg').modal('show');
                            jQuery('#modal-uploadingmsg').on('show.bs.modal', function (event) {
                                jQuery(this).find('.modalmsg').text(msg);
                            });
                            return false;
                        }
                        else
                        {
                            if(jQuery('.qq-upload-retry-selector:not(.qq-hide)').length<=0)
                            {
                            }
                            else
                            {
                                var msg = 'Some Images not uploded complete';
                                if(jQuery('body').attr('data-lang')=="ar")
                                {
                                    msg = 'هناك بعض العناصر لمك يكتمل تحميلها بشكل صحيح';
                                }
                                jQuery('#modal-uploadingmsg').modal('show');
                                jQuery('#modal-uploadingmsg').on('show.bs.modal', function (event) {
                                    jQuery(this).find('.modalmsg').text(msg);
                                });
                                return false;
                            }
                        }
                    }
                    if(!haveItems() && val == "publishNow"){
                        flag=true;
                        var msg="Add at least one image/video";
                        toastr["error"](msg, "error");
                        return false;
                    }
                }

                function ajax_submit()
                {
                    jQuery.ajax({
                        type: 'POST',
                        url: this_click.attr("action"),
                        dataType: 'json',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            if (jQuery('body').hasClass('body-site') == false) {
                                App.blockUI({
                                    boxed: true
                                });
                            }
                        },
                        success: function (data) {
                            if (data.flag) {
                                var myRoute = data.myRoute;
                                var Article_ID = data.Article_ID;

                                if (val == "publishNow") {
                                    confirm(data.message, "cp-attar/" + myRoute + "/preview/" + Article_ID);
                                } else {
                                    flag = true;
                                    confirm(data.message, data.route);
                                }
                            }
                        },
                        error: function (data) {
                            flag = true;
                            console.log(data);
                            if (jQuery('body').hasClass('body-site') == false) {
                                App.unblockUI()
                            }
                            toasterMessage("error", "You have: " + data.responseJSON.errorsNo + " Errors", "Check Errors");
                        }
                    });
                }

                if(check_uploading()==true)
                {
                    var item_no = 0;
                    jQuery('.hdnfile').each(function() {
                        if(!jQuery(this).val())
                        {
                            item_no++;
                        }
                        else
                        {
                            var ext = jQuery(this).val().split('.').pop().toLowerCase();
                            if($.inArray(ext, ['bin']) >= 0)
                            {
                                item_no++;
                            }
                        }
                    });
                    bootbox.confirm("The "+item_no+" files are being uploaded, if you leave now the upload will be cancelled ?", function(result) {
                        if(result==true)
                        {
                            ajax_submit();
                        }
                        else
                        {
                            flag = true;
                        }
                    });
                }
                else
                {
                    ajax_submit();
                }
            }

            return false;
        });

        $("form button[type=submit]").click(function () {
            $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
            $(this).attr("clicked", "true");
        });
    };

    return {
        init: function (route) {
            //handleErrors();
            //handleInputsValid();
            handleValidationForm();
            counWordAndCharacter();
            saveForm(route);

        }
    };
}
();

function reshowArabicLanguage() {
    if (jQuery(".articleArabic").parent().hasClass("active")) {
        jQuery('[data-lang=ar]').not(".language_switch").show();
        jQuery('[data-lang=en]').not(".language_switch").hide();
        changeLanguage("ar");
    }
    else {
        jQuery('[data-lang=ar]').not(".language_switch").hide();
        jQuery('[data-lang=en]').not(".language_switch").show();
        changeLanguage("en");
    }

    //Tinymce.init();
}

function gallery(route, route2) {
    jQuery(document).on("change", ".has_gallary_check", function (e) {
        if (flag) {
            var thisclick = jQuery(this);
            flag = false;
            if (jQuery(this).prop("checked")) {
                jQuery.ajax({
                    type: 'GET',
                    url: route,
                    dataType: 'html',
                    success: function (data) {
                        flag = true;
                        jQuery(".new-article-gallary").html(data);
                        input_wlbl();
                        upload_filer();
                    }
                });
            } else {
                if (jQuery("input[name=Gall_ID]").val()) {
                    bootbox.confirm("Note, Gallery will deleted, are you sure?", function (result) {
                        if (result) {
                            jQuery.ajax({
                                type: 'GET',
                                url: route2 + "/" + jQuery("input[name=Gall_ID]").val(),
                                dataType: 'html',
                                success: function (data) {
                                    flag = true;
                                    jQuery(".new-article-gallary").html("");
                                },
                                error: function () {
                                    flag = true;
                                    jQuery(".new-article-gallary").html("");
                                }
                            });
                        } else {
                            thisclick.prop("checked", true);
                            thisclick.parent().addClass("checked");
                            flag = true;
                        }
                    });

                } else {
                    jQuery(".new-article-gallary").html("");
                }

            }
        }


    });
}

window.gallery = gallery;

jQuery(document).ready(function () {
    reshowArabicLanguage();


    $('.datepicker-mintoday').datepicker({

        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true,

        startDate: new Date()
    });


    jQuery(document).on("click", ".articleArabic", function () {
        reshowArabicLanguage();

    });

    jQuery(document).on("click", ".articleEnglish", function () {
        reshowArabicLanguage();
    });

});