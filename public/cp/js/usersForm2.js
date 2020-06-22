
jQuery(document).ready(function () {
    $('.textarea').wysihtml5();
    $('.datepicker').datepicker({changeYear: true, yearRange : 'yy-50:yy+1'});
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
                                window.top.location="crm/user/create";
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

    $("form button[type=submit]").click(function () {
        $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
        $(this).attr("clicked", "true");
    });

     jQuery(document).on('click', '.attmodal', function () {
        var id = jQuery(this).attr('data-id');
        jQuery(".id").val(id);

       var target = jQuery(this).attr('data-modal');
      
    
        jQuery('#' + target).modal('show');
          jQuery('.modal-body-attach').load('/crm/headline/attachImage/'+id);
        return false;
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