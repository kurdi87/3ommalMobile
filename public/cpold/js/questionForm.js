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









///////
    $.fn.select2.defaults.set("theme", "bootstrap");
    var placeholder = "Select an option";







function toasterMessage(type, message, title) {
    toastr[type](message, title);
}

window.toasterMessage = toasterMessage;
});