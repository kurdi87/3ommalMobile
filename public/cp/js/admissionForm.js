jQuery(document).ready(function () {
    var flag = true;

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   

$(document).ready(function() {
  $(window).keydown(function(admission){
    if(admission.keyCode == 13) {
      admission.pradmissionDefault();
      return false;
    }
  });
});


    jQuery(document).on('click', '.dischargeModal', function () {
        var eid = jQuery(this).attr('data-id');
        var target = jQuery(this).attr('data-modal');
        jQuery('#' + target).modal('show');
        jQuery('.modal-body-discharge').load('crm/admission/discharge/' + eid);
        return false;
    });
    jQuery(document).on('submit', '#addDischarge', function () {
        var thisAction = jQuery(this);
        //  var proid = jQuery(this).find('#pro_id :selected').val();


        if (!errors) {
            jQuery.ajax({
                url: "crm/admission/addDischarge",

                type: 'POST',
                data: thisAction.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status) {
                        //oTable.draw();

                        //  $("#pro_id option[value="+proid+"]").remove();

                        jQuery('#modal-discharge').find('.form-control').val('');
                        jQuery('#modal-discharge').modal('hide');

                        input_wlbl();
                        toasterMessage("success", data.message, "Updated Successfully");

                    }
                },
                error: function (data) {
                    toasterMessage("error", "Error", "Check Error");
                }
            });
        }

        return false;
    });





    jQuery(document).on('change', '.patient', function () {
        window.location='crm/admission/create?patient_id=' + this.value
    });
///////








function toasterMessage(type, message, title) {
    toastr[type](message, title);
}

window.toasterMessage = toasterMessage;
});