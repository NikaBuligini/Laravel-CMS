@extends('layouts.admin')

@section('content')
	<div class="admin-page-container full">
		<div class="admin-page-content">
			{!! Form::open(array('url' => '/admin/group', 'method' => 'post')) !!}
				@include('admin/group/form')
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