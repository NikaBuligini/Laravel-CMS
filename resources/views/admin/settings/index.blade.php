@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content three-fourth">
			@if($settings)
				{!! Form::open(array('url' => '/admin/settings/1', 'method' => 'put', 'class' => 'form-horizontal')) !!}
			@else
				{!! Form::open(array('url' => '/admin/settings', 'method' => 'post', 'class' => 'form-horizontal')) !!}
			@endif
				
				<div class="form-group">
					{!! Form::label('name', 'Website Name', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-8">
						{!! Form::text('name', $settings['name'], ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('description', 'Website Description', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-8">
						{!! Form::textarea('description', $settings['description'], ['class' => 'form-control', 'rows' => '4']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('keys', 'Meta Keys', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-8">
						{!! Form::text('keys', $settings['keys'], ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('meta_description', 'Meta Description', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-8">
						{!! Form::textarea('meta_description', $settings['meta_description'], ['class' => 'form-control', 'rows' => '4']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('company', 'Company', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-8">
						{!! Form::text('company', $settings['company'], ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('language', 'Default Language', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-8">
						{!! Form::select('language', $languages, $settings['language'], ['class' => 'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('mode', 'Maintance', ['class' => 'col-sm-3 control-label']) !!}
					<div class="col-sm-8">
						{!! Form::select('mode', $modes, $settings['mode'], ['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-8">
						{!! Form::submit($button_text, ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@endsection