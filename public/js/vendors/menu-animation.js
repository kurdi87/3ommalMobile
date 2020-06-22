
$(document).ready(function () {
	$("#burger, #mobile-menu").click(() => {
		let menuHeight = $("#mobile-menu .menu-content").innerHeight();
		$("#burger, #mobile-menu").toggleClass('is-open');
		$(" #mobile-menu").css('height', menuHeight + 'px');
		$('.site-container').fadeToggle();
	})
});
