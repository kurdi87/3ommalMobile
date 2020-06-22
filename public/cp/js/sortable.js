jQuery(document).ready(function () {

    function packages_container_sortable() {
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
            start: function () {
            },
            stop: function () {
                App.init();
                jQuery('.editorarea textarea.tinymce').each(function () {
                    tinyMCE.execCommand('mceRemoveEditor', false, jQuery(this).attr('id'));
                });
                jQuery('.editorarea textarea.tinymce').each(function () {
                    tinyMCE.execCommand('mceAddEditor', false, jQuery(this).attr('id'));
                });
            }
        });
    }

    window.packages_container_sortable = packages_container_sortable;
    packages_container_sortable();

    function offers_sortable() {
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
            start: function () {
            },
            stop: function () {
                App.init();
                jQuery('.editorarea textarea.tinymce').each(function () {
                    tinyMCE.execCommand('mceRemoveEditor', false, jQuery(this).attr('id'));
                });
                jQuery('.editorarea textarea.tinymce').each(function () {
                    tinyMCE.execCommand('mceAddEditor', false, jQuery(this).attr('id'));
                });
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
            }
        });
    }

    window.flights_sortable = flights_sortable;
    flights_sortable();

    function gallery_sortable() {
        jQuery(".gallery-list").sortable({
			//containment: "parent",
            containment: ".tab-content",
            connectWith: ".gallery-list",
            items: ".gallery-item", 
            opacity: 0.8,
            handle : '.gallery-title',
            coneHelperSize: true,
            //placeholder: 'portlet-sortable-placeholder',
            forcePlaceholderSize: true,
            tolerance: "pointer",
            helper: "clone",
            tolerance: "pointer",
            forcePlaceholderSize: !0,
            helper: "clone",
            cancel: ".cancel-move", // cancel dragging if portlet is in fullscreen mode
            revert: 250, // animation in milliseconds
            start: function(){
                jQuery('.gallery-list .gallery-item').addClass('gitem-moving');
                jQuery('input[type=radio]').removeAttr('checked');
                jQuery('.myradio').prop('checked',true);

            },
            stop: function(){
                App.init();
                jQuery('.gallery-list .gallery-item').removeClass('gitem-moving');
                jQuery('input[type=radio]').removeAttr('checked');
                jQuery('.myradio').prop('checked',true);
            }
        });
    }

    window.gallery_sortable = gallery_sortable;
    gallery_sortable();

    jQuery(document).on('change','input[type=radio]',function() {
        if(jQuery(this).prop('checked'))
        {
            jQuery('input[type=radio]').removeClass('myradio');
            jQuery(this).addClass('myradio');
        }
    });

    jQuery(window).load(function() {
        jQuery('.cover-img input[type=radio]').each(function() {
            if(jQuery(this).prop('checked'))
            {
                jQuery(this).addClass('myradio');
            }
        });
    });

});

