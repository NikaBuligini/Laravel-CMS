@extends('layouts.admin')

@section('content')
	<script src="{{ asset('/tinymce/tinymce.min.js') }}"></script>

	<div class="admin-page-container three-fourth">
		<div class="admin-page-content">
			{!! Form::open(array('url' => '/admin/banner/'.$banner['id'], 'method' => 'put', 'class' => 'form-horizontal')) !!}
				@include('admin/banner/form', ['button_text' => 'Update Banner'])
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