@extends('layouts.admin')

@section('content')
	<script src="{{ asset('/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>

	<div class="admin-page-container three-fourth">
		<div class="admin-page-content">
			{!! Form::open(array('url' => '/admin/content', 'method' => 'post', 'class' => 'form-horizontal')) !!}
				@include('admin/content/form', ['button_text' => 'Create Content'])
			{!! Form::close() !!}

			@if($errors->any())
				<ul class="alert alert-danger">
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			@endif
		</div>
	</div>
@endsection