@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content half">
			<div>
				<span>Header</span>
				<a href="menu/create?location=header" class="btn green-btn"><i class="fa fa-plus"></i></a>
				<button id="new-header" type="button" class="btn green-btn" data-toggle="modal" data-target=".bs-new-header-modal-lg">Add</button>
				<div class="modal bs-new-header-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg menu-modal">
						<div id="header-modal" class="modal-content">
							@include('admin/menu/modal_form', [
								'parent_id' => 0,
								'menu' => $base_header,
								'final' => true,
								'isCreate' => true,
								'button_id' => 'create_header'])
						</div>
					</div>
				</div>
			</div>

			@if($header)
			<div id="header-list" class="menu-builder-container noselect" data-id="0">
				{!! $menu->renderChildren('header') !!}
				<button type="button" class="btn green-btn save" data-target="header">Save</button>
			</div>
			@endif
		</div>
	</div>
	<div class="admin-page-container">
		<div class="admin-page-content half">
			<div>
				<span>Footer</span>
				<a href="menu/create?location=footer" class="btn green-btn"><i class="fa fa-plus"></i></a>
				<button id="new-footer" type="button" class="btn green-btn" data-toggle="modal" data-target=".bs-new-footer-modal-lg">Add</button>
				<div class="modal bs-new-footer-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg menu-modal">
						<div id="footer-modal" class="modal-content">
							@include('admin/menu/modal_form', [
								'parent_id' => 0,
								'menu' => $base_footer,
								'final' => true,
								'isCreate' => true,
								'button_id' => 'create_footer'])
						</div>
					</div>
				</div>
			</div>

			@if($footer)
			<div id="footer-list" class="menu-builder-container noselect" data-id="0">
				{!! $menu->renderChildren('footer') !!}
				<button type="button" class="btn green-btn save" data-target="footer">Save</button>
			</div>
			@endif
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$(function() {
				var sortable_options = {
					revert: false,
					handle: '.dd-handle',
					placeholder: 'dd-highlight',
					opacity: 0.8,
					helper: 'clone',
					scroll: false
				}

				var h = $('#header-list .dd-list').sortable(sortable_options);
				var f = $('#footer-list .dd-list').sortable(sortable_options);

				$('.save').click(function(event) {
					$target = $(this).attr('data-target');

					if ($target == 'header') {
						var parent_id = $('#header-list').attr('data-id');
						save(h, parent_id, ' header');
					} else if ($target == 'footer') {
						var parent_id = $('#footer-list').attr('data-id');
						save(f, parent_id, ' footer');
					} else {
						console.log('unknown target');
					}
				});

				function save(target, parent_id, location) {
					var order = target.sortable('toArray', {attribute: 'data-id'});
					console.log(order);
					console.log(parent_id);

					$.post('/laravel/public/admin/menu/updateOrder', {order: order, parent: parent_id},
						function(data) {
							if (data.success) {
								show_alert('success', data.message + (parent_id == 0 ? location : ''));
							} else {
								show_alert('error', "Something went wrong. Update didn't happened");
							}
						}
					);
				}

				$('.delete_toggle').click(function() {
					console.log('clicked');
					var elem = $(this);

					$.post('/laravel/public/admin/menu/ajaxDestroy', {menu_id: elem.attr('rel')}, function(data) {
						console.log(data);
						if (data.success) {
							elem.closest('li').remove();
							show_alert('success', 'Menu has been deleted')
						} else {
							show_alert('error', 'Failed to delete menu');
						}
						console.log(data.id);
					});
				});

				$('.dd').disableSelection();

				$('.dd-handle').mousedown(function() {
					$('.dd-handle').css('cursor', '-webkit-grabbing')
				});
				$('.dd-handle').mouseup(function() {
					$('.dd-handle').css('cursor', '-webkit-grab')
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