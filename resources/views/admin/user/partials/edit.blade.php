<div class="half {{ $tab == 2 ? '' : 'none' }}">
	<div class="admin-page-container full">
		<div class="admin-page-content">
			{!! Form::open(array('url' => '/admin/user/'.$user['id'], 'method' => 'put')) !!}
				<div class="form-group">
					{!! Form::label('name', 'Name:') !!}
					{!! Form::text('name', $user['name'], ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('email', 'Email:') !!}
					{!! Form::text('email', $user['email'], ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('group_id', 'Group').Html::popover('asdevz') !!}
					{!! Form::select('group_id', $groups, $user['group_id'], ['class' => 'form-control']) !!}
				</div>
				<div class="checkbox">
					{!! Form::label('active', 'Active', ['class' => 'checkbox-label']) !!}
					{!! Form::checkbox('active', 'Active', $user['active'] == 1) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Update User Info', ['class' => 'btn btn-primary form-control']) !!}
				</div>
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
</div>