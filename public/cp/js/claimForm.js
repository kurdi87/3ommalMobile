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
      claim.prclaimDefault();
      return false;
    }
  });
});








    jQuery(document).on('change', '.patient', function () {
        window.location='crm/claim/create?patient_id=' + this.value
    });
    jQuery(document).on('change', '#finance_party', function () {
        jQuery(this).parents('.form-body').find('.claimevent').removeClass('hidden');
        jQuery(this).parents('.form-body').find('.claimevenitems').find('.checked').removeClass('checked');
        jQuery(this).parents('.form-body').find('.claimevenitems').find('.ccheckbox').attr('checked', '');
        jQuery(this).parents('.form-body').find('.claimevent').addClass('hidden');
        jQuery(this).parents('.form-body').find('.'+this.value+'').removeClass('hidden');

    });
///////








function toasterMessage(type, message, title) {
    toastr[type](message, title);
}

window.toasterMessage = toasterMessage;
});