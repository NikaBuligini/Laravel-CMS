@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content half">
			{!! Form::open(array('url' => '/admin/user', 'method' => 'post')) !!}
				@if(Session::has('flash_message'))
					<div class="group-alert alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
						@if(Session::has('flash_message_important'))
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						@endif

						{!! Session::get('flash_message') !!}
					</div>
				@else
					<div class="alert alert-info alert-important" role="alert">
						<p>Default value for 'Valid Until' field is today until 12PM. You probably would like to change it for more convinient
						time, for example tomorrow, or day after tommorow.</p>
					</div>
				@endif
				
				<div class="form-group">
					{!! Form::label('group_id', 'Group:') !!}
					{!! Form::select('group_id', $groups, $user['role_id'], ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('valid_until', 'Valid Until:') !!}
					{!! Form::input('date', 'valid_until', date('Y-m-d'), ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit($button_text, ['class' => 'btn btn-primary form-control']) !!}
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

	<div class="admin-page-container">
		<div class="admin-page-content half">
			<h5 class="content-header">Pending Registration Links</h5>
			@if(Session::has('link_flash_message'))
				<div class="group-alert alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
					@if(Session::has('flash_message_important'))
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					@endif

					{!! Session::get('link_flash_message') !!}
				</div>
			@endif
			@if($registration_links->toArray())
				<span>Copy link address and give it to someone for register</span>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Link</th>
							<th class="column-date">Group</th>
							<th class="column-action">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($registration_links as $key => $link)
							<tr>
								<td><a href="{{ URL::to('admin/auth/register?_token='.$link['_token']) }}">{{ $link['_token'] }}</a></td>
								<td><a href="{{ action('Admin\GroupController@show', ['group' => $link->group['id']]) }}">{{ $link->group['name'] }}</a></td>
								<td class="actions-column">
									<div class="actions-container">
										<div class="actions">
											<a href="{{ action('Admin\UserController@destroy', ['id' => $link['id']]) }}" class="red-btn button" title="Delete">
												<i class="fa fa-trash-o"></i>
											</a>
										</div>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<p>There are no pending registration links. Just click generate button to create new one.</p>
			@endif
		</div>
	</div>

	<script>
		$('div.alert').not('.alert-important').delay(3000).slideUp(300);
	</script>
@endsection