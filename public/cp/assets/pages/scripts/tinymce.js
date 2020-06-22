var Tinymce = function () {

    return {
        //main function to initiate the module
        init: function () {
            tinymce.init({
                selector: ".tinymce",//.tinymce
                plugins: [
                    "autoresize",
                    "link lists charmap hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
                    "table contextmenu directionality template paste fullpage textcolor textpattern"
                ],
                toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | cut copy paste | searchreplace | bullist numlist | outdent indent blockquote",
                toolbar2: "table | removeformat | charmap | ltr rtl | visualchars visualblocks nonbreaking restoredraft | insertfile undo redo | link unlink code",
                image_advtab: true,
                menubar: false,
                toolbar_items_size: 'small',
                autoresize_min_height: 200,
                autoresize_bottom_margin: 50,
                autoresize_max_height: 400
            });
        }
    };

}();

jQuery(document).ready(function () {
    Tinymce.init();
});

