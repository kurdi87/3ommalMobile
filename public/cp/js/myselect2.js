jQuery(document).ready(function () {
    var placeholder = "Select an option";
    var flag = true;

    function myselect2() {
        $(".myselect2").select2({
            placeholder: placeholder,
            width: null,
            dropdownCssClass: "myselect2",
            language: {
                noResults: function () {
                    return "No found <a href='#' class='btn-addtoselect'>Add</a>";
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });
    }

    window.myselect2 = myselect2;
    myselect2();

    jQuery(document).on('click', '.btn-addtoselect', function (e) {
        var this_select2 = jQuery('.myselect2 .select2-search__field');
        var input_val = this_select2.val().trim();
        jQuery('.selectrole-rg select.myselect2').append('<option selected="" value="' + input_val + '">' + input_val + '</option>');
        myselect2();
        jQuery('.selectrole-rg.select2-wlbl').find('.lblselect').addClass('lblselecttop');
        jQuery(".mycheckbox").removeAttr("checked").parents("label").removeClass("blue").removeClass("green").removeClass("red");

        /*jQuery.ajax({
         url: "cp-attar/role/store",
         type: 'POST',
         data: {"Role_Name": input_val, "quick": true},
         dataType: "json",
         success: function (data) {
         if (data.status) {
         jQuery('.selectrole-rg select.myselect2').append('<option selected="" value="' + data.Role_ID + '">' + data.Role_Name + '</option>');
         myselect2();
         jQuery('.selectrole-rg.select2-wlbl').find('.lblselect').addClass('lblselecttop');
         jQuery(".mycheckbox").removeAttr("checked").parents("label").removeClass("blue").removeClass("green").removeClass("red");
         jQuery('.form-validation').append("<input type='hidden' name='newRole' value='" + data.Role_ID + "' />");
         } else {
         toasterMessage("error", data.message, "CHeck Error");
         }
         }
         });*/
        e.preventDefault();
        return false;
    });

    jQuery(document).on('change', '.myselect2', function () {
        var thisclick = jQuery(this);
        var roleid = thisclick.val();
        if (roleid && flag) {
            flag = false;
            jQuery(".mycheckbox").removeAttr("checked").parents("label").removeClass("blue").removeClass("green").removeClass("red");
            jQuery.ajax({
                url: "cp-attar/user/actionRole/" + roleid,
                type: 'GET',
                dataType: "json",
                success: function (data) {
                    flag = true;
                    if (data.status) {
                        jQuery(".mycheckbox").each(function () {
                            if (inArray(jQuery(this).val(), data.result)) {
                                jQuery(this).prop("checked", true).parents("label").removeClass("blue red black green").addClass("blue");
                            }
                        });
                    } else {
                        toasterMessage("error", data.message, "CHeck Error");
                    }
                },
                error: function (data) {
                    toasterMessage("error", "Please Check Selected Role", "CHeck Error");
                }
            });
        }
    });
});

function inArray(needle, haystack) {
    var length = haystack.length;
    for (var i = 0; i < length; i++) {
        if (haystack[i] == needle) return true;
    }
    return false;
}