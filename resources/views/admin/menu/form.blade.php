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
<div class="form-group {{ $initial ? 'none' : '' }}">
	{!! Form::label('parent_id', 'Parent ID:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::select('parent_id', $menus, $menu['parent_id'], ['class' => 'form-control']) !!}
	</div>
</div>
<div class="form-group {{ $hide_location ? 'none' : '' }}">
	{!! Form::label('location_id', 'Location:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::select('location_id', $menuLocations, $menu['location_id'], ['class' => 'form-control']) !!}
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
		{!! Form::submit($button_text, ['class' => 'btn btn-primary form-control']) !!}
	</div>
</div>