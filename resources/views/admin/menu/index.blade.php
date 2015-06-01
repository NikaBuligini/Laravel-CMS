@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content half">
			<div>
				<span>Header</span>
				<a href="menu/create?location=header" class="btn green-btn"><i class="fa fa-plus"></i></a>
			</div>

			@if($header)
			<div id="header-list" class="menu-builder-container noselect">
				{!! $menu->renderChildren('header') !!}
			</div>
			@endif
		</div>
	</div>
	<div class="admin-page-container">
		<div class="admin-page-content half">
			<div>
				<span>Footer</span>
				<a href="menu/create?location=footer" class="btn green-btn"><i class="fa fa-plus"></i></a>
			</div>

			@if($footer)
			<div id="footer-list" class="menu-builder-container noselect">
				{!! $menu->renderChildren('footer') !!}
			</div>
			@endif
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$(function() {
				var h = $('#header-list .dd-list').sortable({
					revert: false,
					handle: '.dd-handle',
					placeholder: 'dd-highlight',
					opacity: 0.8,
					helper: 'clone',
					scroll: true
				});

				var f = $('#footer-list .dd-list').sortable({
					revert: false,
					handle: '.dd-handle',
					placeholder: 'dd-highlight',
					opacity: 0.8,
					helper: 'clone',
					scroll: true
				});
				
				$('#save-header').click(function() {
					var order = h.sortable('toArray', {attribute: 'data-id'});
					console.log(order);

					$.post('/laravel/public/admin/menu/updateOrder', {order: order},
						function(data) {
							console.log('result');
							console.log(data);
						}
					);
				});

				$('.dd').disableSelection();

				$('.dd-handle').mousedown(function() {
					$('.dd-handle').css('cursor', '-webkit-grabbing')
				});
				$('.dd-handle').mouseup(function() {
					$('.dd-handle').css('cursor', '-webkit-grab')
				});
			});
		});
	</script>
@endsection