jQuery(document).ready(function () {

    jQuery(document).on('click', '#packagetitle,.packagetitle', function () {
        return false;
    });

    function package_title() {
        $('#packagetitle,.packagetitle').editable({
            inputclass: 'inputpackage-title input-medium',
            type: 'text',
            pk: 1,
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