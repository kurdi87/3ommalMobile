var flag = true;
function reshowArabicLanguage(lang) {
    if (lang == "ar") {
        jQuery('[data-lang=ar]').show();
        jQuery('[data-lang=en]').hide();
    }
    else {
        jQuery('[data-lang=ar]').hide();
        jQuery('[data-lang=en]').show();
    }
}

jQuery(document).ready(function () {
    reshowArabicLanguage("en");
    jQuery(document).on("click", ".articleArabic", function () {
        reshowArabicLanguage("ar");
    });

    jQuery(document).on("click", ".articleEnglish", function () {
        reshowArabicLanguage("en");
    });

    jQuery(document).on('click', '.remove-about-image', function () {
        var thisclick = jQuery(this);
        var title = thisclick.parents(".upload-image-rg").find('.uploadfile-img').attr('data-title');
        bootbox.confirm("Are you sure?", function (result) {
            if (result == true) {
                thisclick.parents(".upload-image-rg").find("input[type=hidden]").val(1);
                thisclick.parents(".upload-image-rg").find('.uploadfile-img').val('').removeClass('fileimg-required').addClass('fileimg-required');
                thisclick.parents(".upload-image-rg").removeAttr('style');
                thisclick.remove();
            }
        });
    });
});