@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content half">
			<div class="action-buttons">
				<a href="{{ action('Admin\GroupController@edit', ['group' => $group['id']]) }}" class="btn blue-btn">
					<i class="fa fa-pencil-square-o"></i>
					<span>Edit</span>
				</a>
				<a href="{{ action('Admin\GroupController@destroy', ['group' => $group['id']]) }}" class="btn red-btn" disabled="disabled">
					<i class="fa fa-trash-o"></i>
					<span>Delete</span>
				</a>
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