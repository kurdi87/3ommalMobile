(function ($) {

    // Navba

    jQuery(document).on('click', '.tabbotton', function () {
        
        var nexttab = jQuery(this).attr('nexttab');
        var currenttab = jQuery(this).attr('currenttab');
        jQuery(this).parents('.tabbable-line').find('.' + currenttab).removeClass("active");
        jQuery(this).parents('.tabbable-line').find('.' + nexttab).addClass("active");
       

        return false;
    });













})(window.jQuery);



