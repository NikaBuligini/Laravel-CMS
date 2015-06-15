@extends('layouts.admin')

@section('content')
	<div class="two-from-three float-left-section">
		<div class="admin-page-container full">
			<div class="admin-page-content">
				<span>Contents</span>
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