
var StaticPages = function () {

	var handleSaveCurrentTab = function() {
		jQuery(document).on("click", ".staticpages-nav>li>a",function() {
			jQuery('.hdn-staticpages').val(jQuery(this).attr('href'));
			return false;
	    });
    };

    var handleOpenSavedTab = function() {
    	var thistarget = jQuery('.hdn-staticpages').val();
		$('.staticpages-nav a[href="'+thistarget+'"]').tab('show');
    };

	return {
		init: function () {
			handleSaveCurrentTab();
			handleOpenSavedTab();
        }
	};

}();

jQuery(document).ready(function() {
    
    StaticPages.init();

});