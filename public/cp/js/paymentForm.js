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
      event.preventDefaultEvents();
      return false;
    }
  });
});








    jQuery(document).on('change', '.service_provider', function () {
        if(this.value==204)
        jQuery(this).parents('.row').find('.commission').removeClass('hidden');
        else
        jQuery(this).parents('.row').find('.commission').addClass('hidden');

    });

///////








function toasterMessage(type, message, title) {
    toastr[type](message, title);
}

window.toasterMessage = toasterMessage;
});