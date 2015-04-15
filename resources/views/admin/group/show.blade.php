@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content half">
			<div class="action-buttons">
				<a href="{{ action('Admin\GroupController@edit', ['group' => $group['id']]) }}" class="btn blue-btn">
					<i class="fa fa-pencil-square-o"></i>
					<span>Edit</span>
				</a>
				<a href="{{ action('Admin\GroupController@destroy', ['group' => $group['id']]) }}" class="btn red-btn" data-toggle="modal" data-target="#myModal">
					<i class="fa fa-trash-o"></i>
					<span>Delete</span>
				</a>
				<!-- Modal -->
				<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Modal title</h4>
							</div>
							<div class="modal-body">
								...
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div> -->
			</div>
			<table class="table table-bordered show-table">
				<tbody>
					<tr class="active">
						<td>ID</td>
						<td>{{ $group['id'] }}</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>{{ $group['name'] }}</td>
					</tr>
					<tr>
						<td>Role</td>
						<td>{{ $role['name'] }}</td>
					</tr>
					<tr>
						<td>Level</td>
						<td>{{ $role['level'] }}</td>
					</tr>
					<tr>
						<td>Description</td>
						<td>{{ $group['description'] }}</td>
					</tr>
					<tr>
						<td>Created At</td>
						<td>{{ $group['created_at'] }}</td>
					</tr>
				</tbody>
			</table>
		</div>

		@if($users)
			<div class="admin-page-content half">
				<h5>Users from this group:</h5>
					@foreach($users as $key => $user)
						<a href="{{ action('Admin\UserController@show', ['user' => $user['id']]) }}">{{ $user['name'].(end($users)['id'] != $user['id'] ? ',' : '') }}</a>
					@endforeach
			</div>
		@endif
	</div>

@endsection