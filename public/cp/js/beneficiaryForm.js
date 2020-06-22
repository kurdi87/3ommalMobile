jQuery(document).ready(function () {
    var flag = true;

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   

$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

    jQuery(document).on('change', '.weight', function () {
        var height = jQuery(this).parents('form').find('.height').val();
        var weight = jQuery(this).val();

        if(height=='' || height==0)
            height=0;

        var bmi = (weight/((height/100)^2));

        jQuery(this).parents('form').find('.bmi').attr('value',bmi);


        return false;
    });
    jQuery(document).on('change', '.height', function () {
        var weight = jQuery(this).parents('form').find('.weight').val();
        var height = jQuery(this).val();

        if(height=='' || height==0)
            height=0;

        var bmi = (weight/((height/100)^2));

        jQuery(this).parents('form').find('.bmi').attr('value',bmi);


        return false;
    });




jQuery(document).on('change', '.upload-beneficiary-img', function () {

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
                    url: 'hitechjobs/beneficiary/uploadImage/'+id,
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
                            var src = "img/beneficiary/" + data.file_name;
                            my_button.parents('.upload-beneficiary-img').css('background-image', 'url(' + src + ')');
                            my_button.parents('.upload-beneficiary-img').find('.icon').attr('value',data.file_name);
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
  

    

});





function toasterMessage(type, message, title) {
    toastr[type](message, title);
}

window.toasterMessage = toasterMessage;