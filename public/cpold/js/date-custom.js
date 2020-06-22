


jQuery(document).ready(function() {    
    
    $('.datepicker-maxtoday').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true,
        endDate: '0'
    });

    $('.datepicker-mintoday').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true,
        endDate: '0'
    });
    
});