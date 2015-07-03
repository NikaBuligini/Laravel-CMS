@extends('layouts.admin')

@section('content')
	<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

	<div class="two-from-three float-left-section">
		<div class="admin-page-container full">
			<div class="admin-page-content">
				<a href="{{ action('Admin\ContentController@create', ['menu' => $menu['id']]) }}">Create new content</a>
			</div>
		</div>
	</div>

	<div class="one-from-three float-left-section">
		<div class="admin-page-container full">
			<div class="admin-page-content">
				<div id="list" class="sorable-list" data-id="{{ $menu->id }}" data-location="{{ $menu->location_id }}"></div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="{{ asset('/js/menu.js') }}"></script>
@endsection