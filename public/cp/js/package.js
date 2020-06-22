var hasChange = false;
var flag = true;

function changeHappen() {
    if (hasChange == false)
        console.log('page in editing now');

    hasChange = true;
}

function reshowArabicLanguage() {
    if (jQuery(".packageArabic").parent().hasClass("active")) {
        jQuery('[data-lang=ar]').show();
        jQuery('[data-lang=en]').hide();
    }
    else {
        jQuery('[data-lang=ar]').hide();
        jQuery('[data-lang=en]').show();
    }
}

function resetAjaxSelect() {
    $("select.airports").select2({
        ajax: {
            url: "cp-attar/ajax/airports",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                    results: data.data,
                    pagination: {
                        more: (params.page * 30) < data.total
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1
    });

    $("select.airlines").select2({
        ajax: {
            url: "cp-attar/ajax/airlines",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                    results: data.data,
                    pagination: {
                        more: (params.page * 30) < data.total
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1
    });
}

var AddOffer = function () {
    return {
        init: function () {
            jQuery(document).on('click', '.btn-add-offer', function () {
                var this_click = jQuery(this);
                var ObjectTop;
                var objectId = this_click.parents('.portlet').find('input[name*=PackObj_ID]').val();
                if (flag) {
                    flag = false;
                    jQuery.ajax({
                        type: 'GET',
                        url: "./cp-attar/packages/offer/" + objectId,
                        dataType: 'json',
                        success: function (data) {
                            if (data.status) {
                                flag = true;
                                this_click.parents('.box-bt-wbtn').find('.offers-list').append(data.result);
                                reshowArabicLanguage();
                                jQuery('input[name=Pack_ID]').val(data.Pack_ID);
                                App.init();
                                Tinymce.init();
                                ComponentsBootstrapSelect.init();
                                jQuery('[data-toggle="tooltip"],.tooltip').tooltip();

                                if (this_click.parents('.box-bt-wbtn').find('.offers-list>.portlet').size() > 1) {
                                    this_click.parents('.box-bt-wbtn').find('.offers-list>.portlet').addClass('offer-item');
                                    this_click.parents('.box-bt-wbtn').find('.offers-list').removeClass('cancel-move');
                                    offers_sortable();
                                }

                                ObjectTop = this_click.parents('.box-bt-wbtn').find('.offers-list .portlet').last().offset().top;
                                jQuery('html,body').animate({scrollTop: ObjectTop - 60}, 400);
                                changeHappen();
                            }
                        }
                    });
                }

                return false;
            });

            jQuery(document).on('click', '.add-informative,.add-flightobject,.add-containerobject', function () {
                var this_click = jQuery(this);
                var type = this_click.attr('data-type');
                var ObjectTop;
                if (flag) {
                    flag = false;
                    jQuery.ajax({
                        type: 'GET',
                        url: "./cp-attar/packages/object",
                        data: {type: type, Pack_ID: jQuery('input[name=Pack_ID]').val(), Pack_Name: jQuery('input[name=Pack_Name]').val()},
                        dataType: 'json',
                        success: function (data) {
                            if (data.status) {
                                flag = true;
                                this_click.parents('body').find('.packages-container-lists').append(data.result);
                                reshowArabicLanguage();
                                jQuery('input[name=Pack_ID]').val(data.Pack_ID);
                                App.init();
                                Tinymce.init();
                                ComponentsBootstrapSelect.init();
                                ComponentsSelect2.init();
                                ComponentsDateTimePickers.init();
                                resetAjaxSelect();
                                jQuery('[data-toggle="tooltip"],.tooltip').tooltip();

                                ObjectTop = this_click.parents('body').find('.packages-container-lists .portlet').last().offset().top;
                                jQuery('html,body').animate({scrollTop: ObjectTop - 60}, 400);

                                changeHappen();
                                close_sidebar();
                            }
                        }
                    });
                }
                return false;
            });

            jQuery(document).on('click', '.btn-add-flight', function () {

                var this_click = jQuery(this);
                var ObjectTop;
                var objectId = this_click.parents('.portlet').find('input[name*=PkgFlt_ID]').val();
                if (flag) {
                    flag = false;
                    jQuery.ajax({
                        type: 'GET',
                        url: "./cp-attar/packages/trip/" + objectId,
                        dataType: 'json',
                        success: function (data) {
                            flag = true;
                            if (data.status) {
                                this_click.parents('.box-bt-wbtn').find('.flights-list').append(data.result);
                                reshowArabicLanguage();
                                App.init();
                                ComponentsDateTimePickers.init();
                                ComponentsBootstrapSelect.init();
                                ComponentsSelect2.init();
                                resetAjaxSelect();
                                jQuery('[data-toggle="tooltip"],.tooltip').tooltip();

                                if (this_click.parents('.box-bt-wbtn').find('.flights-list>.portlet').size() > 1) {
                                    this_click.parents('.box-bt-wbtn').find('.flights-list>.portlet').addClass('flight-item');
                                    this_click.parents('.box-bt-wbtn').find('.flights-list').removeClass('cancel-move');
                                    flights_sortable();
                                }

                                ObjectTop = this_click.parents('.box-bt-wbtn').find('.flights-list .portlet').last().offset().top;
                                jQuery('html,body').animate({scrollTop: ObjectTop - 60}, 400);

                                changeHappen();
                            }
                        }
                    });
                }

                return false;
            });
        }
    };
}();

var options = {
    types: ['(cities)']
};
var places = new google.maps.places.Autocomplete(document.getElementById('google-autocomplete'), options);
google.maps.event.addDomListener(window, 'load', function () {
    google.maps.event.addListener(places, 'place_changed', function () {
        var place = places.getPlace();
        var place_id = place.place_id;
        var address = place.formatted_address;

        var lengths = 0;
        jQuery('.myplaces-list>li').each(function () {
            if (jQuery(this).find('input[type="hidden"]').val() == place_id) {
                lengths++;
                jQuery(this).find('input[value="' + place_id + '"]').parent().css('opacity', '0').animate({opacity: 1}, 500);
            }
        });
        if (lengths == 0) {
            jQuery('.myplaces-list').find('.input-place').before('<li><span class="fa fa-close del-place"></span> ' + address + ' <input name="destination[]" type="hidden" value="' + place_id + '" /></li>');
            jQuery('#google-autocomplete').val('');
        }
    });
});

jQuery(document).ready(function () {
    flag = true;

    jQuery(document).on('click','.btn-articlesave',function() {
        //alert();
        App.blockUI({
            boxed: true
        });
        /*App.unblockUI();*/
    });

    jQuery(document).on('keyup change','input.form-control,textarea.form-control',function(){
        if ((jQuery(this).val().trim().length >= 2)) {
            jQuery(this).removeClass('has-error');
            jQuery(this).parents('.form-group').removeClass('has-error');
            jQuery(this).parents('.form-group').find('.help-block.error').remove();
        }
    });

    jQuery('select').change(function(){
        if(jQuery(this).find('option:selected').val().length>0)
        {
            jQuery(this).removeClass('has-error');
            jQuery(this).parents('.form-group').removeClass('has-error');
            jQuery(this).parents('.form-group').find('.help-block.error').remove();
        }
    });

    resetAjaxSelect();
    AddOffer.init();
    reshowArabicLanguage();

    jQuery(document).on("click", ".packageArabic", function () {
        jQuery('[data-lang=en]').hide();
        jQuery('[data-lang=ar]').show();
        Tinymce.init();
    });

    jQuery(document).on("click", ".packageEnglish", function () {
        jQuery('[data-lang=ar]').hide();
        jQuery('[data-lang=en]').show();
        Tinymce.init();
    });

    jQuery(document).on('change', '.flight-type', function () {
        var this_click = jQuery(this);
        if (this_click.find('option:selected').attr("data-tripType") == "ONE_WAY_TRIP") {
            this_click.parents('.box-bt-wbtn').removeClass('boxbtn-open');
            if (this_click.parents('.box-bt-wbtn').find('.offers-list').find('.portlet').size() >= 2) {
                bootbox.confirm("Note, all trips will deleted, are you sure?", function (result) {
                    if (result) {
                        this_click.parents('.box-bt-wbtn').find('.flights-list>.portlet').each(function () {
                            if (jQuery(this).index() != 0) {
                                jQuery(this).hide().prepend("<input type='hidden' name='isDeleted[" + jQuery(this).find('input[name*=PackObj_ID]').val() + "][" + jQuery(this).find('.sub-item').val() + "]' value='true' />");
                            }
                        });
                        changeHappen();
                    } else {
                        this_click.val(2);
                        this_click.selectpicker('refresh');
                        this_click.parents('.box-bt-wbtn').addClass('boxbtn-open');
                    }
                });
            }
        }
        else {
            this_click.parents('.box-bt-wbtn').addClass('boxbtn-open');
        }
    });

    jQuery(document).on('click', '.del-pcontainer', function () {
        var this_click = jQuery(this);
        bootbox.confirm("Are you sure delete " + this_click.parents(".portlet-title").find(".caption>span").text() + "?", function (result) {
            if (result) {
                var containerId = this_click.parents('.portlet').find('input[name*=PackObj_ID]').val();
                if (flag) {
                    flag = false;
                    jQuery.ajax({
                        type: 'GET',
                        url: "cp-attar/packages/deletecontainer",
                        dataType: 'json',
                        data: {'id': containerId},
                        success: function (data) {
                            flag = true;
                            if (data.status) {
                                toasterMessage("info", this_click.parents(".portlet-title").find(".caption>span").text() + " Deleted Successfully", "Object Delete");
                                this_click.parents('.pcontainer-item').remove();
                            }
                        }
                    });
                }
            }
        });

        return false;
    });

    jQuery(document).on('click', '.del-item', function () {
        var this_click = jQuery(this);
        bootbox.confirm("Are you sure delete " + this_click.parents(".portlet-title").find(".caption>span").text() + "?", function (result) {
            if (result) {
                var containerId = this_click.parents('.portlet').find('input[name*=PackObj_ID]').val();
                var itemId = this_click.parents('.box-item').find('.sub-item').val();
                var itemType = this_click.parents('.box-item').find('.sub-item').attr('name');
                jQuery.ajax({
                    type: 'GET',
                    url: "cp-attar/packages/deleteitem",
                    dataType: 'json',
                    data: {'containerId': containerId, 'itemId': itemId, 'itemType': itemType},
                    success: function (data) {
                        if (data.status) {
                            if (this_click.parents('.offers-list').find('.portlet').size() == 2) {
                                this_click.parents('.offers-list').find('.portlet').removeClass('offer-item');
                                this_click.parents('.offers-list').addClass('cancel-move');
                            }
                            if (this_click.parents('.flights-list').find('.portlet').size() == 2) {
                                this_click.parents('.flights-list').find('.portlet').removeClass('flight-item');
                                this_click.parents('.flights-list').addClass('cancel-move');
                            }
                            toasterMessage("info", this_click.parents(".portlet-title").find(".caption>span").text() + " Deleted Successfully", "Object Delete");
                            this_click.parents('.box-item').remove();
                        }
                    }
                });

            }
        });

        return false;
    });

    jQuery(document).on('change', '.form-control', function () {
        if (jQuery("#maintitle").val()) {
            changeHappen();
        }
    });

    jQuery(window).load(function () {
        jQuery(".form-tag").addClass("form-control");
    });

    jQuery(document).on('submit', 'form', function (e) {
        hasChange = false;
    });

    setInterval(function () {
        if (hasChange && jQuery("#maintitle").val() && flag) {
            hasChange = false;
            flag = false;
            var form = jQuery('#package-form');

            jQuery.ajax({
                type: 'POST',
                url: form.attr('action'),
                dataType: 'json',
                data: form.serialize(),
                success: function (data) {
                    flag = true;
                    if (data.status) {
                        console.log("saved...");
                        history.pushState('', 'New URL: ' + data.url, data.url);
                        jQuery('input[name*=Pack_ID]').val(data.Pack_ID);
                    }
                }
            });
        }
    }, 15000);

    $(window).on('beforeunload', function () {
        if (hasChange)
            return 'Are you sure you want to leave?';
    });


    jQuery(document).on('click', '.del-place', function () {
        jQuery(this).parents('li').remove();
        changeHappen();
    });

    // sorting start
    function packages_container_sortable() {
        var timymceid;
        jQuery(".packages-container-lists").sortable({
            items: ".pcontainer-item",
            opacity: 0.8,
            handle: '.parent-title',
            coneHelperSize: true,
            placeholder: 'portlet-sortable-placeholder',
            forcePlaceholderSize: true,
            tolerance: "pointer",
            helper: "clone",
            tolerance: "pointer",
            forcePlaceholderSize: !0,
            helper: "clone",
            cancel: ".portlet-sortable-empty, .portlet-fullscreen", // cancel dragging if portlet is in fullscreen mode
            revert: 250, // animation in milliseconds
            update: function (b, c) {
                if (c.item.prev().hasClass("portlet-sortable-empty")) {
                    c.item.prev().before(c.item);
                }
            },
            start: function (event, ui) {
                timymceid = ui.item.find('.tinymce').attr('id');
                tinyMCE.execCommand('mceRemoveEditor', false, timymceid);
            },
            stop: function () {
                App.init();
                tinyMCE.execCommand('mceAddEditor', false, timymceid);
                changeHappen();
            }
        });
    }

    window.packages_container_sortable = packages_container_sortable;
    packages_container_sortable();

    function offers_sortable() {
        var timymceid;
        jQuery(".offers-list").sortable({
            //connectWith: ".portlet",
            items: ".offer-item",
            opacity: 0.8,
            handle: '.portlet-title',
            coneHelperSize: true,
            placeholder: 'portlet-sortable-placeholder',
            forcePlaceholderSize: true,
            tolerance: "pointer",
            helper: "clone",
            tolerance: "pointer",
            forcePlaceholderSize: !0,
            helper: "clone",
            cancel: ".cancel-move", // cancel dragging if portlet is in fullscreen mode
            revert: 250, // animation in milliseconds
            update: function (b, c) {
                if (c.item.prev().hasClass("portlet-sortable-empty")) {
                    c.item.prev().before(c.item);
                }
            },
            start: function (event, ui) {
                timymceid = ui.item.find('.tinymce').attr('id');
                tinyMCE.execCommand('mceRemoveEditor', false, timymceid);
            },
            stop: function () {
                App.init();
                tinyMCE.execCommand('mceAddEditor', false, timymceid);
                changeHappen();
            }
        });
    }

    window.offers_sortable = offers_sortable;
    offers_sortable();

    function flights_sortable() {
        jQuery(".flights-list").sortable({
            items: ".flight-item",
            opacity: 0.8,
            handle: '.portlet-title',
            coneHelperSize: true,
            placeholder: 'portlet-sortable-placeholder',
            forcePlaceholderSize: true,
            tolerance: "pointer",
            helper: "clone",
            tolerance: "pointer",
            forcePlaceholderSize: !0,
            helper: "clone",
            cancel: ".cancel-move", // cancel dragging if portlet is in fullscreen mode
            revert: 250, // animation in milliseconds
            update: function (b, c) {
                if (c.item.prev().hasClass("portlet-sortable-empty")) {
                    c.item.prev().before(c.item);
                }
            },
            start: function () {
            },
            stop: function () {
                App.init();
                changeHappen();
            }
        });
    }

    window.flights_sortable = flights_sortable;
    flights_sortable();

    jQuery('.offers-list').each(function () {
        if (jQuery(this).find('.portlet').size() >= 2) {
            jQuery(this).find('.portlet').addClass('offer-item');
        }
        else {
            jQuery(this).find('.portlet').removeClass('offer-item');
        }
    });

    jQuery('.flights-list').each(function () {
        if (jQuery(this).find('.portlet').size() >= 2) {
            jQuery(this).find('.portlet').addClass('flight-item');
        }
        else {
            jQuery(this).find('.portlet').removeClass('flight-item');
        }
    });

    $('#maintitle').editable({
        inputclass: 'form-control input-medium',
        type: 'text',
        pk: 1,
        value: $('#maintitle').val(),
        validate: function (value) {
            if ($.trim(value) == '') return 'This field is required';
        },
        display: function (value) {
            if (value) {
                jQuery(this).val(value);
                jQuery(this).parents('.form-group').find('.lblinput').addClass('lblinputtop');
                enabled_all_inputs(elements, exceptInputID);
            }
        }
    });

    function disabled_all_inputs(elements, exceptInputID) {

        jQuery(elements).each(function () {
            if (jQuery(elements).is("div")) {
                jQuery(this).find('.form-control:not(' + exceptInputID + ')').each(function () {
                    jQuery(this).attr('disabled', 'disabled');
                });
            }
            jQuery(elements).each(function () {
                jQuery(this).attr('disabled', 'disabled');
            });
        });
    }

    window.disabled_all_inputs = disabled_all_inputs;

    function enabled_all_inputs(elements, exceptInputID) {
        jQuery(elements).find('.form-control:not(' + exceptInputID + ')').each(function () {
            jQuery(this).removeAttr('disabled');
        });
        jQuery(elements).each(function () {
            jQuery(this).removeAttr('disabled');
        });
    }

    jQuery(document).on('click', '#packagetitle,#packagetitle>i,.packagetitle,.packagetitle>i', function () {
        return false;
    });

    function package_title() {
        $('#packagetitle,.packagetitle').editable({
            inputclass: 'inputpackage-title input-medium',
            type: 'text',
            pk: 1,
            //placement: "right",
            //value: ,
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            display: function (value) {
                if (value) {
                    var mylink = jQuery(this).attr('href');
                    var newlink = mylink + '?Pack_Name=' + encodeURI(value);
                    var clonelink = encodeURI(newlink);
                    window.location.replace(clonelink);
                    return true;
                }
            }
        });
    }

    window.package_title = package_title;
    package_title();

});