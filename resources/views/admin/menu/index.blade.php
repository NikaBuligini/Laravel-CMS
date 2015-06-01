@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content half">
			<div>
				<span>Header</span>
				<a href="menu/create?location=header" class="btn green-btn"><i class="fa fa-plus"></i></a>
			</div>

			@if($header)
			<div class="menu-builder-container">
				<ul class="dd noselect">
					@foreach($header as $menu)
					<li class='dd-item nested-list-item' data-order='{{ $menu->order }}' data-id='{{ $menu->id }}'>
						<div class='nested-list-content'>
							<div class='dd-handle nested-list-handle'>
								<span class='fa fa-arrows-alt'></span>
							</div>
							{{ $menu->name_en }}
							<div class='pull-right'>
								<a href="{{ url('admin/menu/edit/'.$menu->id) }}">Edit</a> |
								<a href='#' class='delete_toggle' rel='{{ $menu->id }}'>Delete</a>
							</div>
						</div>
						<ul class="dd">
							<li class='dd-item nested-list-item' data-order='0' data-id='0'>
								<div class='nested-list-content'>
									<div class='dd-handle nested-list-handle'>
										<span class='fa fa-arrows-alt'></span>
									</div>
									a
									<div class='pull-right'>
										<a href="{{ url('admin/menu/edit/'.$menu->id) }}">Edit</a> |
										<a href='#' class='delete_toggle' rel='{{ $menu->id }}'>Delete</a>
									</div>
								</div>
							</li>
						</ul>
					</li>
					@endforeach
				</ul>
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
			<ul>
				@foreach($footer as $menu)
				<li>{{ $menu->name_en }}</li>
				@endforeach
			</ul>
			@endif
		</div>
	</div>

	<script type="text/javascript">
		$(function() {
			$('.dd').sortable({
				containment: '.half',
				revert: false,
				handle: '.dd-handle',
				placeholder: 'dd-highlight',
				opacity: 0.8,
			});

			$('.dd').disableSelection();

			$('.dd-handle').mousedown(function() {
				$('.dd-handle').css('cursor', '-webkit-grabbing')
			});
			$('.dd-handle').mouseup(function() {
				$('.dd-handle').css('cursor', '-webkit-grab')
			});
		});
	</script>
@endsection