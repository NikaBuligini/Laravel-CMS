$(document).ready(function() {
	var needsUpdate = false;

	var sortable_options = {
		revert: false,
		handle: 'img',
		placeholder: 'dd-highlight',
		cursor: '-webkit-grabbing',
		opacity: 0.8,
		helper: 'clone',
		scroll: false,
		update: function(event, ui) {
			needsUpdate = true;
			$('#save').removeAttr('disabled');
		}
	}

	$('.banners').sortable(sortable_options);

	$('#save').click(function(event) {
		event.preventDefault();

		var order = $('.banners').sortable('toArray', {attribute: 'data-id'});

		$.post(url_head + '/public/admin/banner/updateOrder', {order: order},
			function(data) {
				if (data.success) {
					show_alert('success', data.message);

					needsUpdate = false;
					$('#save').attr('disabled', 'disabled');
				} else {
					show_alert('error', "Something went wrong. Update didn't happened");
				}
			}
		);
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
});