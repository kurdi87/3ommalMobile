
jQuery(document).ready(function () {

    var flag=true;
    jQuery(document).on("submit", ".user-form", function () {
        var this_click = jQuery(this);
        var formData = new FormData($(this)[0]);
        var val = $("button[type=submit][clicked=true]").attr("name");

        if (flag && !errors) {
            flag = false;

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
                    if (data.status) {
                        toasterMessage("success", data.message, "Success");

                        setTimeout(function(){
                            if(val=="save_new"){
                                window.top.location="crm/userCustomer/create";
                            }else{
                                window.top.location="crm/user";
                            }
                        },2000);
                        
                    }
                },
                error: function (data) {
                    flag = true;
                    console.log(data);
                    if (jQuery('body').hasClass('body-site') == false) {
                        App.unblockUI()
                    }
                    toasterMessage("error", "You have some errors", "Check Errors");
                }
            });
        }

        return false;
    });
    jQuery(document).on('change', '.upload-customer-profile-img', function () {

        if (flag == true) {
            flag = false;
            var user= $('.user_id').val();
            var my_file = this.files[0];
            var my_button = jQuery(this);
            var size = parseInt(this.files[0].size);
            size = size / 1024;
            var file = jQuery(this).val();
            var extension = file.substr((file.lastIndexOf('.') + 1)).toLowerCase();
            var type = false;
            if (extension == 'jpg' || extension == 'jpeg' || extension == 'png')
                type = true;

            if (size <= 4096 && type == true) {
                var fd = new FormData();
                fd.append("choose-file", my_file);
                fd.append("user_id", user);
                jQuery.ajax({
                    url: '/crm/userCustomer/uploadCustomerProfile/'+user,
                    type: 'POST',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {
                        //    my_button.parent().append('<div class="loading-submit"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
                    },
                    success: function (data) {
                        flag = true;
                        //    my_button.parent().find('.loading-submit').remove();
                        if (data.status == true) {
                            var src = "uploads/userCustomer/" + data.file_name;
                            my_button.parents('.upload-avatar-img').css('background-image', 'url(' + src + ')');
                        } else {
                            flag = true;
                            var message = data.message;
                            toasterMessage("error", message, "Upload Error");
                        }
                    }
                });

            } else {
                flag = true;
                my_button.parent().find('.loading-submit').remove();
                jQuery(this).val("");
                var message = '';
                if (size > 4096)
                    message = 'size is too big';
                if (type == false)
                    message = 'format not accepted';
                toasterMessage("error", message, "Upload Error");
            }
        }

    });
    $("form button[type=submit]").click(function () {
        $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
        $(this).attr("clicked", "true");
    });

    jQuery(document).on('change', '#module', function () {
        var status=$('#moduleN').attr('value',this.options[this.selectedIndex].text);

    });

      jQuery(document).on('change', '.icondepartment', function () {
        var t =  $('.icondepartment :selected').val();
       
         jQuery(this).parents('.row').find('#flaticon').removeClass();

          jQuery(this).parents('.row').find('#flaticon').addClass('flaticon iconsize');
        jQuery(this).parents('.row').find('#flaticon').addClass(t);
        return false;
    });




    /*jQuery(window).load(function(){
        jQuery(".permissions-checks").find("ul>li").find(".checkbox-inline").each(function(){
            if(!jQuery(this).hasClass("green") && !jQuery(this).hasClass("red") && !jQuery(this).hasClass("blue") && !jQuery(this).hasClass("black")){
                jQuery(this).addClass("black");
            }
        });
    });*/
});