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
      card.prcardDefault();
      return false;
    }
  });
});








    jQuery(document).on('change', '.beneficiary', function () {
        window.location='crm/card/create?beneficiary_id=' + this.value
    });
    jQuery(document).on('change', '.dependency', function () {
        window.location='crm/card/create?dependency_id=' + this.value +'&beneficiary_id=' +$('#dependency_id :selected').attr('beneficiary_id');
    });
    jQuery(document).on('change', '#finance_party', function () {
        jQuery(this).parents('.form-body').find('.cardevent').removeClass('hidden');
        jQuery(this).parents('.form-body').find('.cardevenitems').find('.checked').removeClass('checked');
        jQuery(this).parents('.form-body').find('.cardevenitems').find('.ccheckbox').attr('checked', '');
        jQuery(this).parents('.form-body').find('.cardevent').addClass('hidden');
        jQuery(this).parents('.form-body').find('.'+this.value+'').removeClass('hidden');

    });
///////








function toasterMessage(type, message, title) {
    toastr[type](message, title);
}

window.toasterMessage = toasterMessage;
});