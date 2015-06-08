@extends('layouts.admin')

@section('content')
	<div class="admin-page-container half">
		<div class="admin-page-content">
			<div id="list" class="sorable-list" data-id="0" data-location="1"></div>
		</div>
	</div>

	<div class="admin-page-container half">
		<div class="admin-page-content">
			<div id="list" class="sorable-list" data-id="0" data-location="2"></div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$(function() {
				var containers = $('.sorable-list');

				for (var i = 0; i < containers.length; i++) {
					var item = $(containers[i]);
					$.post('/admin/menu/getMenus', 
						{id: item.attr('data-id'), location: item.attr('data-location'), container: i}, 
						function(data) {
							if (data.success) {
								var target = $(containers[data.container]);
								target.html(data.data);

								install(target);
							}
						}
					);
				}

				var sortable_options = {
					revert: false,
					handle: '.dd-handle',
					placeholder: 'dd-highlight',
					cursor: '-webkit-grabbing',
					opacity: 0.8,
					helper: 'clone',
					scroll: false
				}

				function install(elem) {
					var l = elem.find('.dd-list').sortable(sortable_options);

					elem.find('.save').click(function(event) {
						$target = elem.find('.save').attr('data-target');

						var parent_id = elem.find('.dd-list').attr('data-id');
						var location;
						if ($target == 1) {
							location = ' header';
						} else if ($target == 2) {
							location = ' footer';
						} else {
							console.log('unknown target');
						}

						save(l, parent_id, location);
					});

					elem.find('.delete_toggle').click(function() {
						var elem = $(this);

						$.post('/admin/menu/ajaxDestroy', {menu_id: elem.attr('rel')}, function(data) {
							if (data.success) {
								elem.closest('li').remove();
								show_alert('success', 'Menu has been deleted')
							} else {
								show_alert('error', 'Failed to delete menu');
							}
						});
					});

					elem.find('.dd').disableSelection();
				}

				function save(target, parent_id, location) {
					var order = target.sortable('toArray', {attribute: 'data-id'});

					$.post('/admin/menu/updateOrder', {order: order, parent: parent_id},
						function(data) {
							if (data.success) {
								show_alert('success', data.message + (parent_id == 0 ? location : ''));
							} else {
								show_alert('error', "Something went wrong. Update didn't happened");
							}
						}
					);
				}

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


				// $('#create_header').click(function(event) {
				// 	event.preventDefault();
				// 	var form = $('#header-modal form');
					
				// 	var name_ka = form.find('#name_ka').val();
				// 	var name_en = form.find('#name_en').val();
				// 	var name_ru = form.find('#name_ru').val();
				// 	var parent_id = 0;
				// 	var location_id = form.find('#location_id').val();
				// 	var status_id = form.find('#status_id').val();

				// 	console.log('name_ka = ' + name_ka);
				// 	console.log('name_en = ' + name_en);
				// 	console.log('name_ru = ' + name_ru);
				// 	console.log('parent_id = ' + parent_id);
				// 	console.log('location_id = ' + location_id);
				// 	console.log('status_id = ' + status_id);

				// 	$.post('/laravel/public/admin/menu/ajaxStore', 
				// 		{
				// 			name_ka: name_ka,
				// 			name_en: name_en,
				// 			name_ru: name_ru,
				// 			parent_id: parent_id,
				// 			location_id: location_id,
				// 			status_id: status_id
				// 		}, 
				// 		function(data) {
				// 			console.log(data);
				// 		}
				// 	);
				// });

			});
		});
	</script>
@endsection