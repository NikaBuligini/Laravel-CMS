@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content full">
			{!! Form::open(array('url' => '/admin/group/'.$group['id'], 'method' => 'put')) !!}
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