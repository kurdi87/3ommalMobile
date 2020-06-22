jQuery(document).ready(function () {
    var flag = true;

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*jQuery(document).on('change', '.upload-img', function () {

        if (flag == true) {
            flag = false;
            var my_file = this.files[0];
            var my_button = jQuery(this);
            var size = parseInt(this.files[0].size);
            size = size / 1024;
            var file = jQuery(this).val();
            var extension = file.substr((file.lastIndexOf('.') + 1)).toLowerCase();
            var type = false;
            if (extension == 'jpg' || extension == 'jpeg')
                type = true;
            var folder = jQuery(this).attr('data-folder');
            //var my_width = jQuery(this).attr('data-width');
            //var my_height = jQuery(this).attr('data-height');
            if (size <= 4096 && type == true) {
                var fd = new FormData();
                fd.append("choose-file", my_file);
                jQuery.ajax({
                    url: 'cp-brand_buzz/upload/' + folder,
                    type: 'POST',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {
                        my_button.parent().append('<div class="loading-submit"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
                    },
                    success: function (data) {
                        flag = true;
                        my_button.parent().find('.loading-submit').remove();
                        if (data.status == true) {
                            my_button.parent().find('.image-value').val(data.file_name);
                            var src = "";
                            //if (my_height != "0" && my_width != "0") {
                            //    src = data.my_server + "image/" + data.file_name + "/" + folder + "/" + my_width + "/" + my_height;
                            //} else {
                            src = "./uploads/" + folder + "/" + data.file_name;
                            //}
                            //my_button.parents('.uploadimg-rg').find('img').attr('src', src);
                            my_button.parents('.upload-image-rg').css('background-image', 'url(' + src + ')');
                            my_button.parents('.upload-image-rg').append('<span class="rem-imgicon rem-packageimgfile"><i class="fa fa-close"></i></span>');
                            changeHappen();
                        }
                        else {
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

    });*/

///////


$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

jQuery(document).on('change', '.upload-mark-img', function () {

        if (flag == true) {
            flag = false;
            var my_file = this.files[0];
            var my_button = jQuery(this);
            var id=jQuery(this).attr('id');
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
                jQuery.ajax({
                    url: 'cp_brand_buzz/uploadMarkLogo/'+id,
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
                            var src = "uploads/marks/" + data.file_name;
                            my_button.parents('.upload-avatar-img').css('background-image', 'url(' + src + ')');
                        }
                        else {
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

///////
    jQuery(document).on('change', '.apartment', function () {

            var index = $('.apartment').val();
            if(index=="")
            $(this).parents('.col-md-12').find('.actions').hide(200);
            else
            {
               
            url = 'cp_brand_buzz/invoices/create/'+index;
            $(location ).attr("href", url);
            }
            
    });

      jQuery(document).on('change', '.building', function () {

            var index = $('.building').val();
            if(index=="")
            $(this).parents('.col-md-12').find('.actions').hide(200);
            else
            {
               
            url = 'cp_brand_buzz/exinvoices/create/'+index;
            $(location ).attr("href", url);
            }
            
    });


        jQuery(document).on('change', '.mark-address', function () {

       
            var index = $('.mark-address').val();
              url = 'cp_brand_buzz/mark/addressWithID/'+index;
      $( location ).attr("href", url);
            
    });

   jQuery(document).on('change', '.invoice_cost', function () {
   
   var x=  Number($(this).val());
   var y=  Number($(this).parents('.row').find('.remain').val());
   var z=  Number($(this).parents('.row').find('.discount').val());
    $(this).parents('.row').find('.final_cost').attr('value', x+y-z);
   // $(this).parents('.row').find('.finalcost1').attr('value', x+y-z);

    
   
    });

      jQuery(document).on('change', '.discount', function () {
   
   var z=  Number($(this).val());
   var y=  Number($(this).parents('.row').find('.remain').val());
   var x=  Number($(this).parents('.row').find('.invoice_cost').val());
    $(this).parents('.row').find('.final_cost').attr('value', x+y-z);
     $(this).parents('.form-package').find('.myform').load();
   
   
    });
      

        jQuery(document).on('click', '.cost', function () {

           if ($(this).parents('.servshow').find('.addserv').is(':checked')) {
            var x=Number($(this).parents('.form-package').find('.invoice_cost').val());
              var y=Number($(this).val());
              if(x-y>=0)
              $(this).parents('.form-package').find('.invoice_cost').val(x-y);
          $(this).parents('.form-package').find('.invoice_cost').change();
              $(this).val("0");
              $(this).parents('.servshow').find('.addserv').attr('checked',false);
              $(this).parents('.servshow').find('.checked').attr('class','');

          }
   
   
    });

          jQuery(document).on('change', '.paied', function () {
          
             if( Number($(this).val())!=0)
                alert(' سيتم إغلاق الفاتورة على مبلغ  '+$(this).val()+'   بعد الحفظ ');


        });


        jQuery(document).on('change', '.addserv', function () {
          
             if ($(this).is(':checked')) {
           
              var x=Number($('.invoice_cost').val());
              var y=Number($(this).parents('.servshow').find('.cost').val());
              $('.invoice_cost').val(x+y);


        }
        else{
             

                   var x=Number($('.invoice_cost').val());
              var y=Number($(this).parents('.servshow').find('.cost').val());

              if(x-y>=0)
              $('.invoice_cost').val(x-y);

        } 
          $('.invoice_cost').change();

              
    });

       
        jQuery(document).on('change', '.mark-address', function () {

       
            var index = $('.mark-address').val();
              url = 'cp_brand_buzz/mark/addressWithID/'+index;
      $( location ).attr("href", url);
            
    });




    jQuery(document).on('change', '.upload-profile-img', function () {

        if (flag == true) {
            flag = false;
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
                jQuery.ajax({
                    url: 'cp_brand_buzz/uploadProfile',
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
                            var src = "uploads/users/" + data.file_name;
                            my_button.parents('.upload-avatar-img').css('background-image', 'url(' + src + ')');
                        }
                        else {
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



    toastr.options = {
        "closeButton": true,
        "debug": true,
        "positionClass": "toast-bottom-right",
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    jQuery(document).on('click','.rem-packageimgfile',function() {
        var thisclick = jQuery(this);
        bootbox.confirm("Are you sure?", function(result) {
            if(result==true)
            {
                thisclick.parents(".upload-image-rg").find('.image-value,.file-img').val('');
                thisclick.parents(".upload-image-rg").removeAttr('style');
                thisclick.remove();
            }
        });
    });

});

 $('.idgetdate').datepicker({
     dateFormat: 'yyyy-mm-dd',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altField: "#idgetdate",
     altFormat: "yyyy-mm-dd"
 });




function toasterMessage(type, message, title) {
    toastr[type](message, title);
}

window.toasterMessage = toasterMessage;