$.ajaxSetup({
	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

var url_head = '/laravel';

$('#layout-button').click(function (e) {
	e.preventDefault();
	var page_container = $('#page-container');
	var nav_container = $('#left-nav-container');
	if (page_container.hasClass('wide-page')) {
		page_container.removeClass('wide-page');
		nav_container.removeClass('nav-small').addClass('nav-wide');
		$.post(url_head + '/public/admin/ajax/navigation_position', { wide: false });
	} else {
		page_container.addClass('wide-page');
		nav_container.removeClass('nav-wide').addClass('nav-small');
		$.post(url_head + '/public/admin/ajax/navigation_position', { wide: true });
	}
});



function show_alert(type, message) {
	var $cls;
	var $icon;

	switch(type) {
		case 'success':
			$icon = '<i class="fa fa-check"></i>';
			break;
		case 'error':
			$icon = '<i class="fa fa-exclamation-triangle"></i>';
			$cls = 'alert-error-message';
			break;
		default:
			break;
	}

	$('#alert-container').html(
		'<div class="main-alert-container">' + 
			'<div id="flash-message" class="main-alert-content ' + $cls + '">' + 
				$icon + message + 
			'</div>' + 
		'</div>');

	$('div.main-alert-container').not('.alert-important').delay(3000).slideUp(300);
}