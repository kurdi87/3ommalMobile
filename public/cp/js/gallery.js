// JavaScript Document

var Gallery = function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //var default_language = $('.language_switch.active').data('lang');
    var default_language = $('.language_switch').data('lang');

    function changeLanguage(lang) {
        default_language = lang;        
        var gallery_title = $('input[name^="gallery_title"][lang="' + default_language + '"][type="hidden"]').val();
        var gallery_sub_title = $('input[name^="gallery_sub_title"][lang="' + default_language + '"][type="hidden"]').val();

        if(jQuery('body').hasClass('body-site')==false)
        {
            $('.gallery-item').each(function (index, element) {
                $(element).find('input[type="text"]').val($(element).find('input[type="text"]').parent('.form-group').find('input[lang="' + default_language + '"]').val());
                $(element).find('textarea').val($(element).find('textarea').parent('.form-group').find('input[lang="' + default_language + '"]').val());
            });

            $('#gallery_title').val(gallery_title);
            $('#gallery_sub_title').val(gallery_sub_title);

            gtab_validation();
            input_wlbl();
        }
        else
        {
            $('input[name^="gallery_title"][type="hidden"]').val('');
            $('input[name^="gallery_sub_title"][type="hidden"]').val('');

            $('input[name^="gallery_title"][lang="' + default_language + '"][type="hidden"]').val($('#gallery_title').val());
            $('input[name^="gallery_sub_title"][lang="' + default_language + '"][type="hidden"]').val($('#gallery_sub_title').val());

            $('.gallery-item').each(function (index, element) {
                $(element).find('input[type="text"]').parent('.form-group').find('input[type="hidden"]').val('');
                $(element).find('textarea').parent('.form-group').find('input[type="hidden"]').val('');
                $(element).find('input[type="text"]').parent('.form-group').find('input[lang="' + default_language + '"]').val($(element).find('input[type="text"]').val());
                $(element).find('textarea').parent('.form-group').find('input[lang="' + default_language + '"]').val($(element).find('textarea').val());
            });
        }
    }

    var handleSwitchLanguage = function (lang) {
        $('.language_switch').on('show.bs.tab', function (e) {
            default_language = $(e.target).data("lang");
            changeLanguage(default_language);
        });
    };
    window.changeLanguage = changeLanguage;

    var title_error = false;
    var number_error = 0;
    function title_validation() {
        var numberEn = 0;
        var numberAr = 0;
        title_error = false;
        number_error = 0;

        jQuery('#gallery_title ~ input[type=hidden][lang=en]').each(function () {
            if (!jQuery(this).val()) {
                if (default_language == "en") {
                    jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                }
                numberEn++;
                number_error++;
            }
            else {
                if (default_language == "en") {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery('#gallery_title ~ input[type=hidden][lang=ar]').each(function () {
            if (!jQuery(this).val()) {
                if (default_language == "ar") {
                    jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                }
                numberAr++;
                number_error++;
            }
            else {
                if (default_language == "ar") {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        if (numberEn != 0) {
            jQuery('.nav-lang>li').eq(0).addClass('tab-error');
            title_error = true;
        }
        else {
            jQuery('.nav-lang>li').eq(0).removeClass('tab-error');
        }
        if (numberAr != 0) {
            jQuery('.nav-lang>li').eq(1).addClass('tab-error');
            title_error = true;
        }
        else {
            jQuery('.nav-lang>li').eq(1).removeClass('tab-error');
        }
        return title_error;
    }
    window.title_validation = title_validation;

    function gtab_validation() {
        //var tablang = jQuery('.language_switch.active').attr('data-lang');
        jQuery('.input-required ~ input[type=hidden][lang=en]').each(function () {
            if (!jQuery(this).val()) {
                if (default_language == "en") {
                    jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                }
            }
            else {
                if (default_language == "en") {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery('.input-required ~ input[type=hidden][lang=ar]').each(function () {
            if (!jQuery(this).val()) {
                if (default_language == "ar") {
                    jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                }
            }
            else {
                if (default_language == "ar") {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery('.input-subtitle ~ input[type=hidden][lang=en],.input-onelang ~ input[type=hidden][lang=en]').each(function () {
            if (jQuery(this).val()) {
                if (!jQuery(this).parents('.form-group').find('input[type=hidden][lang=ar]').val()) {
                    if (default_language == "ar") {
                        jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                    }
                }
                else {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });

        jQuery('.input-subtitle ~ input[type=hidden][lang=ar],.input-onelang ~ input[type=hidden][lang=ar]').each(function () {
            if (jQuery(this).val()) {
                if (!jQuery(this).parents('.form-group').find('input[type=hidden][lang=en]').val()) {
                    if (default_language == "en") {
                        jQuery(this).parents('.form-group').find('.form-control').addClass('has-error');
                    }
                }
                else {
                    jQuery(this).parents('.form-group').find('.form-control').removeClass('has-error');
                }
            }
        });
    }

    var gallery_errors = false;
    function gallery_validation() {
        var numberEn = 0;
        var numberAr = 0;
        gallery_errors = false;
        number_error = 0;

        gtab_validation();
        
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

        jQuery('.input-subtitle ~ input[type=hidden][lang=en],.input-onelang ~ input[type=hidden][lang=en]').each(function () {
            if (jQuery(this).val()) {
                if (!jQuery(this).parents('.form-group').find('input[type=hidden][lang=ar]').val()) {
                    numberAr++;
                    number_error++;
                }
            }
        });

        jQuery('.input-subtitle ~ input[type=hidden][lang=ar],.input-onelang ~ input[type=hidden][lang=ar]').each(function () {
            if (jQuery(this).val()) {
                if (!jQuery(this).parents('.form-group').find('input[type=hidden][lang=en]').val()) {
                    numberEn++;
                    number_error++;
                }
            }
        });

        //alert(numberEn+','+numberAr);
        if (numberEn != 0) {
            jQuery('.nav-lang>li').eq(0).addClass('tab-error');
            gallery_errors = true;
        }
        else {
            jQuery('.nav-lang>li').eq(0).removeClass('tab-error');
        }
        if (numberAr != 0) {
            jQuery('.nav-lang>li').eq(1).addClass('tab-error');
            gallery_errors = true;
        }
        else {
            jQuery('.nav-lang>li').eq(1).removeClass('tab-error');
        }
        return gallery_errors;
    }
    window.gallery_validation = gallery_validation;
    
    function gallery_numbererrors()
    {
        return number_error;
    }
    window.gallery_numbererrors = gallery_numbererrors;

    jQuery(document).on('keyup', '.input-required', function () {
        if ((jQuery(this).val().trim().length >= 2)) {
            jQuery(this).removeClass('has-error');
        }
        else {
            jQuery(this).addClass('has-error');
        }
    });

    var handleLanguageFields = function () {

        $(document).ready(function (e) {
            // get values form hidden fields into text box
            $('input[name="gallery_title_' + default_language + '"][lang="' + default_language + '"]').each(function (index, element) {
                $('#gallery_title').val($(element).val());
            });
            input_wlbl();
        });

        $(document).on('change', '#gallery_title', function (e) {
            $('input[name^="gallery_title"][lang="' + default_language + '"][type="hidden"]').val($(this).val());
        });

        $(document).on('change', '#gallery_sub_title', function (e) {
            $('input[name^="gallery_sub_title"][lang="' + default_language + '"][type="hidden"]').val($(this).val());
        });

        $(document).on('keyup', 'input[id^="gallery_item_title_"]', function (e) {
            $(this).parent().find('input[type="hidden"][lang="' + default_language + '"]').attr('value', $(this).val());
        });

        $(document).on('keyup', 'textarea[id^="gallery_item_description_"]', function (e) {
            $(this).parent().find('input[type="hidden"][lang="' + default_language + '"]').attr('value', $(this).val());
        });
    };

    var handleAddVideoLink = function (route) {

        $(document).on('click', '.btn-addlink', function (event) {
            var thisclick = $(this);
            var type = 'GALLERY_MEDIA_TYPE_VIDEO';
            var text = thisclick.parents('.input-wbtn').find('.youtube-links').val().trim();
            //var identifier = thisclick.parents('.input-wbtn').find('.youtube-links').val().trim();

            var link = "http://www.youtube.com/watch?v="+text+"";
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = link.match(regExp);
            var identifier = match[7];

            jQuery.ajax({
                type: 'POST',
                url: route,
                data: {identifier: identifier, type: type},
                dataType: 'html',
                success: function (data) {
                    var youtubeReg = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;

                    if (thisclick.parents('.input-wbtn').find('.youtube-links').val().trim()) {
                        //var link = "http://www.youtube.com/watch?v=" + identifier;
                        thisclick.parents('.col-md-6').find('.msg').remove();

                        //if (youtubeReg.test(link) == true) {
                         if(match && match[7].length == 11) {
                            if (jQuery('.gallery-list>[id="' + identifier + '"]').size() == 0) {
                                jQuery('.gallery-row').prepend(data);
                                thisclick.parents('.input-wbtn').find('.youtube-links').val('');
                                //Command: toastr["success"]("Video Added Successfully", "");
                                thisclick.parents('.form-group').after('<div class="msg msg-success">Video Added Successfully</div>');
                                setTimeout(function () {
                                    thisclick.parents('.col-md-6').find('.msg').remove();
                                }, 3000);
                                gallery_sortable();
                                App.init();
                                //ComponentsBootstrapSwitch.init();
                            }
                            else {
                                thisclick.parents('.form-group').after('<div class="msg msg-error">This Video was added</div>');
                                setTimeout(function () {
                                    thisclick.parents('.col-md-6').find('.msg').remove();
                                }, 3000);
                            }
                        }
                        else {
                            thisclick.parents('.form-group').after('<div class="msg msg-error">Video Error</div>');
                            setTimeout(function () {
                                thisclick.parents('.col-md-6').find('.msg').remove();
                            }, 3000);
                        }
                    }
                    return false;
                }
            });
        });

    };

    var handleAddGallery = function (route1, route2) {

        $('form#gallery-form').on('keyup keypress', function (e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                e.preventDefault();
                return false;
            }
        });

        $(document).on('click', '#draft-submit', function (e) {
            e.preventDefault();
            if(title_validation()==false)
            {
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
                            handleGallery(route1, route2, 'GALLERY_STATUS_DRAFT');
                        }
                    });
                }
                else
                {
                    handleGallery(route1, route2, 'GALLERY_STATUS_DRAFT');
                }
            }
            else
            {
                Command: toastr["error"]("Number of erros "+number_error+"", "Message");
            }
        });

        $(document).on('click', '#publish-submit', function (e) {
            e.preventDefault();
            if(gallery_validation()==false && hasCover())
            {
                var msg = "You can't publish the gallery while images still uploading";
                if(jQuery('body').attr('data-lang')=="ar")
                {
                    msg = 'لا يمكن ارسال هذا المحتوى وهنالك صور قيد الرفع';
                }
                if(check_uploading()==true)
                {
                    jQuery('#modal-uploadingmsg').modal('show');
                    jQuery('#modal-uploadingmsg').on('show.bs.modal', function (event) {
                        jQuery(this).find('.modalmsg').text(msg);
                    });
                }
                else
                {
                    if(jQuery('.qq-upload-retry-selector:not(.qq-hide)').length<=0)
                    {
                        handleGallery(route1, route2, 'GALLERY_STATUS_PUBLISH');
                    }
                    else
                    {
                        var msg = 'Few images have not been uploaded successfully';
                        if(jQuery('body').attr('data-lang')=="ar")
                        {
                            msg = 'هناك بعض الصور لم يكتمل رفعها بشكل صحيح';
                        }
                        jQuery('#modal-uploadingmsg').modal('show');
                        jQuery('#modal-uploadingmsg').on('show.bs.modal', function (event) {
                            jQuery(this).find('.modalmsg').text(msg);
                        });
                    }
                }
            }
            else
            {
                if(!hasCover())
                    Command: toastr["error"]("Check Cover Photo", "Message");

                if(number_error)
                    Command: toastr["error"]("Number of erros "+number_error+"", "Message");
            }
        });
    };
    
    var handlerRemoveGalleryItem = function () {
        $(document).on('click', '.remove-video', function (e) {
            //var portlet = $(this).parents('.portlet').eq(0);
            //jQuery(portlet).parents('.col-md-4').remove();
            var thisclick = jQuery(this);
            var msg = "Are you sure?";
            if(jQuery('body').attr('data-lang')=="ar")
            {
                msg = 'هل أنت متأكد من العملية ؟';
            }
            bootbox.confirm(msg, function(result) {
                if(result==true)
                {
                    var fileid = thisclick.parents('.gallery-item').attr('qq-file-id');
                    if(fileid)
                    {
                        $('#fine-uploader-gallery').fineUploader('cancel', fileid);
                        thisclick.parents('.gallery-item').find('.qq-upload-cancel-selector,.qq-upload-delete-selector').click();
                    }
                    thisclick.parents('.gallery-item').remove();
                    //alert(thisclick.parents('.gallery-item').length);
                    //thisclick.parents('.gallery-item').remove();
                    //jQuery('#filer_input2').val('');
                    /*var myindex = thisclick.parents('.gallery-item').attr('data-jfiler-index');
                    var filerKit = $("#filer_input2").prop("jFiler");
                    filerKit.remove(myindex);*/
                }
            });
        });
    };

    function hasCover(){
        return jQuery("input[data-objectname=GallMed_IsHighlighted]:checked").length;
    }
    
    var handleGallery = function (route1, route2, Gall_Status) {

        jQuery.ajax({
            type: 'POST',
            url: 'cp-attar/gallery/add',
            data: jQuery("form").serialize(),
            dataType: 'json',
            beforeSend: function () {
                //title_validation();
                if((jQuery('body').hasClass('body-site')==false))
                {
                    App.blockUI({
                        boxed: true
                    });
                }
            },
            success: function (data) {
                var Gall_ID = data.Gall_ID;
                var formItemsData = gellery_items();
                var flag = true;

                $('#Gall_ID').val(Gall_ID);

                if (Gall_Status == 'GALLERY_STATUS_PUBLISH') {
                    handleGalleryPublishing(route1, Gall_ID, function (myRtn) {
                        if (myRtn == "Success") {
                            toastr.options.positionClass = "toast-top-right";
                                toastr.success("Gallery Saved Successfuly");
                            window.location.href = "cp-attar/gallery";
                            if(jQuery('body').hasClass('body-site')==false) {App.unblockUI()}
                        } else {
                            if(jQuery('body').hasClass('body-site')==false) {App.unblockUI()};
                            toastr.options.positionClass = "toast-top-right";
                            toastr.error("Check gallery items language and cover photo");
                            window.location.href = "cp-attar/gallery/edit/"+Gall_ID;
                        }
                    });
                }
                else {
                    toastr.success("Gallery Saved Successfuly");
                    window.location.href = "cp-attar/gallery/edit/"+Gall_ID;
                }
            },
            error: function (xhr, status, error) {
                toastr.options.positionClass = "toast-top-right";
                var obj = jQuery.parseJSON(xhr.responseText);
                toastr.error(obj.Response_MSG);
            }
        });
    };

    function gellery_items() {
        var myObjMain = new Object();

        jQuery('.gallery-item').each(function () {
            var this_elm = jQuery(this);
            var this_imgname = jQuery(this).attr('data-imgname');
            var myObj = new Object();

            this_elm.find('input[type=hidden]:not([lang],.hdnfile)').each(function () {
                var data_name = jQuery(this).attr('data-objectname');
                var elm_val = jQuery(this).val();
                myObj[data_name] = elm_val;
            });

            this_elm.find('input[type=hidden].hdnfile').each(function () {
                var data_name = jQuery(this).attr('data-objectname');
                var elm_val = jQuery(this).val();
                if (!jQuery(this).parents('.gallery-item').find('.GallMed_ID').val()) {
                    myObj[data_name] = elm_val;
                }
            });

            this_elm.find('.radiocheckbox').each(function () {
                var data_name = jQuery(this).attr('data-objectname');
                var elm_val = jQuery(this).val();
                if (jQuery(this).prop('checked')) {
                    myObj[data_name] = "1";
                }
                else {
                    myObj[data_name] = "0";
                }
            });

            this_elm.find('input[type=hidden][lang=en]').each(function () {
                var data_name = jQuery(this).attr('data-objectname');
                var elm_val_en = jQuery(this).parent().find('input[type=hidden][lang=en]').val();
                var elm_val_ar = jQuery(this).parent().find('input[type=hidden][lang=ar]').val();
                var myObj_lang = new Object();

                myObj_lang['en'] = elm_val_en;
                myObj_lang['ar'] = elm_val_ar;
                myObj[data_name] = myObj_lang;
            });
            myObjMain[this_imgname] = myObj;
        });
        return myObjMain;
    }

    window.gellery_items = gellery_items;

    function getMediaId() {
        var temp = new Array();

        $('.GallMed_ID').each(function (index, element) {
            var GallMed_ID = $(element).val();

            if (GallMed_ID != "")
                temp.push($(element).val());
        });

        return temp;
    }

    window.getMediaId = getMediaId;

    function galleryBasicInfo(Gall_Status) {
        var gallery_title = {
            'en': $('input[name^="gallery_title"][lang="en"]').val(),
            'ar': $('input[name^="gallery_title"][lang="ar"]').val()
        };

        var gallery_sub_title = {
            'en': $('input[name^="gallery_sub_title"][lang="en"]').val(),
            'ar': $('input[name^="gallery_sub_title"][lang="ar"]').val()
        };

        return {
            'gallery_title': gallery_title,
            'gallery_sub_title': gallery_sub_title,
            'Gall_ID': $('#Gall_ID').val(),
            'Gall_Status': Gall_Status,
            'items': getMediaId()
        };
    }

    window.galleryBasicInfo = galleryBasicInfo;

    function tmp(formItemsData, Gall_ID, route) {
        var GallMed_Order = 0;
        //console.log(formItemsData);

        jQuery('.gallery-item').each(function () {
            var this_elm = jQuery(this);
            var myObjMain = new Object();
            var this_elm = jQuery(this);
            var this_imgname = jQuery(this).attr('data-imgname');
            var myObj = new Object();

            this_elm.find('input[type=hidden]:not([lang],.hdnfile)').each(function () {
                var data_name = jQuery(this).attr('data-objectname');
                var elm_val = jQuery(this).val();
                myObj[data_name] = elm_val;
            });

            this_elm.find('input[type=hidden].hdnfile').each(function () {
                var data_name = jQuery(this).attr('data-objectname');
                var elm_val = jQuery(this).val();
                if (!jQuery(this).parents('.gallery-item').find('.GallMed_ID').val()) {
                    myObj[data_name] = elm_val;
                }
            });

            this_elm.find('.radiocheckbox').each(function () {
                var data_name = jQuery(this).attr('data-objectname');
                var elm_val = jQuery(this).val();
                if (jQuery(this).prop('checked')) {
                    myObj[data_name] = "1";
                }
                else {
                    myObj[data_name] = "0";
                }
            });

            this_elm.find('input[type=hidden][lang=en]').each(function () {
                var data_name = jQuery(this).attr('data-objectname');
                var elm_val_en = jQuery(this).parent().find('input[type=hidden][lang=en]').val();
                var elm_val_ar = jQuery(this).parent().find('input[type=hidden][lang=ar]').val();
                var myObj_lang = new Object();

                myObj_lang['en'] = elm_val_en;
                myObj_lang['ar'] = elm_val_ar;
                myObj[data_name] = myObj_lang;
            });
            myObjMain[this_imgname] = myObj;

            //console.log(myObj);
            //console.log(myObjMain);
            //alert(Gall_ID);

            myObj['Gall_ID'] = Gall_ID;
            myObj['GallMed_Order'] = ++GallMed_Order;

            console.log(myObj);

            jQuery.ajax({
                type: 'POST',
                url: route,
                data: myObj,
                dataType: 'json',
                async: false,
                beforeSend: function () {
                    //blockui
                },
                success: function (data) {
                    //alert(data.GallMed_ID);
                    this_elm.find('.GallMed_ID').val(data.GallMed_ID);
                },
                error: function (data) {
                    //alert(22);
                }
            });
        });
        //return myObjMain;

        /*$.each(formItemsData, function(index, value) {
         console.log(formItemsData[index]);
         formItemsData[index]['Gall_ID'] = Gall_ID;
         formItemsData[index]['GallMed_Order'] = ++GallMed_Order;
         jQuery.ajax({
         type: 'POST',
         url: route,
         data: formItemsData[index],
         dataType: 'json',
         async: false,
         beforeSend: function () {
         },
         success: function (data) {
         alert(11);
         },
         error: function (data) {
         alert(22);
         }
         });
         });*/

        /*for (var obj in formItemsData) {
         // append gallery id to each item
         formItemsData[obj]['Gall_ID'] = Gall_ID;
         formItemsData[obj]['GallMed_Order'] = ++GallMed_Order;

         console.log(formItemsData[obj]);

         jQuery.ajax({
         type: 'POST',
         url: route,
         data: formItemsData[obj],
         dataType: 'html',
         async: false,
         beforeSend: function () {
         },
         success: function (data) {
         alert(111);
         },
         error: function (data) {
         alert(222);
         }
         });
         }*/
    }

    function handleItems(formItemsData, Gall_ID, route, xhrSuccess) {
        $.when(
            tmp(formItemsData, Gall_ID, route)
        ).then(
            xhrSuccess()
        )
    }

    function xhrSuccess() {
        return true;
    }

    function xhrError() {
        return false;
    }

    function handleGalleryPublishing(route, Gall_ID, callBack) {

        var href = route + "/status/" + Gall_ID;
        var flag;

        jQuery.ajax({
            type: 'GET',
            url: href,
            data: {},
            beforeSend: function () {
            },
            dataType: 'json',
            success: function (data) {
                myRtnA = "Success";
                flag = true;
                return callBack(myRtnA);
            },
            error: function (xhr, status, error) {
                myRtnA = "Error"
                flag = false;
                return callBack(xhr);
            }
        });
        return flag;
    }

    window.handleItems = handleItems;

    return {
        init: function (route1, route2, route3) {
            handleAddGallery(route1, route3);
            handleAddVideoLink(route2);
            handleLanguageFields();
            handleSwitchLanguage();
            handlerRemoveGalleryItem();
        }
    };
}();

