@extends('layouts.admin')

@section('content')
	<div class="admin-page-container middle-half">
		<div class="admin-page-content">
			{!! Form::open(array('url' => '/admin/menu/'.$menu['id'], 'method' => 'put', 'class' => 'form-horizontal')) !!}
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