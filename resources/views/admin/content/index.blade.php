@extends('layouts.admin')

@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pannel content_form">
						{!! Form::open(array('url' => '#', 'method' => 'post', 'class' => 'form-horizontal')) !!}
							<div class="form-group">
								{!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Search...', 'autocomplete' => 'off']) !!}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection