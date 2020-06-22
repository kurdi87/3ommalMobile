

jQuery(document).ready(function() {    
    /*$('.datepicker-month').datetimepicker({
        viewMode: 'years',
        format: 'MM/YYYY'
    });*/
	$('.datepicker-month').datepicker({
	    minViewMode: 1,
	    autoclose: true,
	    format: 'yyyy-mm'
	});
});