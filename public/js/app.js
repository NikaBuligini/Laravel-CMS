$.ajaxSetup({
	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

$('#layout-button').click(function (e) {
	e.preventDefault();
	var page_container = $('#page-container');
	var nav_container = $('#left-nav-container');
	if (page_container.hasClass('wide-page')) {
		page_container.removeClass('wide-page');
		nav_container.removeClass('nav-small').addClass('nav-wide');
		$.post('/admin/ajax/navigation_position', { wide: false });
	} else {
		page_container.addClass('wide-page');
		nav_container.removeClass('nav-wide').addClass('nav-small');
		$.post('/admin/ajax/navigation_position', { wide: true });
	}
});