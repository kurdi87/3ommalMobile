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








    jQuery(document).on('change', '.patient0', function () {
        window.location='crm/event/create?patient_id=' + this.value
    });
    jQuery(document).on('change', '.patient3', function () {
        window.location='crm/event/create?type=3&patient_id=' + this.value
    });
///////
    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select an option";







function toasterMessage(type, message, title) {
    toastr[type](message, title);
}

window.toasterMessage = toasterMessage;
});