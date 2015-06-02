{!! Form::open(array('url' => '/admin/menu', 'method' => 'post', 'class' => 'form-horizontal menu-modal-form')) !!}
	<div class="form-group">
		{!! Form::label('name_ka', 'Name:', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::text('name_ka', $menu['name_ka'], ['class' => 'form-control', 'placeholder' => 'Georgian']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('name_en', ' ', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::text('name_en', $menu['name_en'], ['class' => 'form-control', 'placeholder' => 'English']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('name_ru', ' ', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::text('name_ru', $menu['name_ru'], ['class' => 'form-control', 'placeholder' => 'Russian']) !!}
		</div>
	</div>
	{!! Form::hidden('parent_id', $parent_id) !!}
	<div class="form-group">
		{!! Form::label('location_id', 'Location:', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::select('location_id', $menuLocations, $menu['location_id'], ['class' => 'form-control',
				$final ? 'disabled' : '']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('status_id', 'Status:', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::select('status_id', $menuStatuses, $menu['status_id'], ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-8">
			{!! Form::submit($isCreate ? 'Create' : 'Update', ['class' => 'btn btn-primary form-control', 'id' => $button_id]) !!}
		</div>
	</div>
{!! Form::close() !!}