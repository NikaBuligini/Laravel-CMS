@extends('layouts.admin')

@section('content')
	<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

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

	<script type="text/javascript" src="{{ asset('/js/menu.js') }}"></script>
@endsection