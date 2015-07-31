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
		console.log(order);

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
});