<div class="form-group">
	{!! Form::label('name', 'Name:') !!}
	{!! Form::text('name', $group['name'], ['class' => 'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('role_id', 'Level:') !!}
	{!! Form::select('role_id', $roles, $group['role_id'], ['class' => 'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('description', 'Description:') !!}
	{!! Form::textarea('description', $group['description'], ['class' => 'form-control', 'rows' => '5']) !!}
</div>
<div class="form-group">
	{!! Form::submit($button_text, ['class' => 'btn btn-primary form-control']) !!}
</div>