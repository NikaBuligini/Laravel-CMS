@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content middle-half">
			{!! Form::open(array('url' => '/admin/menu', 'method' => 'post', 'class' => 'form-horizontal')) !!}
				@include('admin/menu/form')
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