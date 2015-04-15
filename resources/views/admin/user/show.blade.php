@extends('layouts.admin')

@section('content')
	<div class="half activities-container">
		<div class="admin-page-container">
			@foreach($activities as $key => $activity)
			<div class="admin-page-content full activity">
				<!-- <a href="#" class="user">UserName</a> -->
				<span class="time">{{ $activity->created_at->diffForHumans() }}</span>
				<p class="text">{!! $activity->text !!}</p>
			</div>
			@endforeach
		</div>
	</div>

	<div class="half">
		<div class="admin-page-container">
			<div class="admin-page-content full">
				<div class="action-buttons">
					@if($user['id'] != Auth::user()->id)
						<a href="{{ action('Admin\UserController@edit', ['user' => $user['id']]) }}" class="btn blue-btn">
							<i class="fa fa-pencil-square-o"></i>
							<span>Edit</span>
						</a>
					<a href="{{ action('Admin\UserController@destroy', ['user' => $user['id']]) }}" class="btn red-btn" data-toggle="modal" data-target="#myModal">
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
					@endif
				</div>
				<table class="table table-bordered show-table">
					<tbody>
						<tr class="active">
							<td>ID</td>
							<td>{{ $user['id'] }}</td>
						</tr>
						<tr>
							<td>Name</td>
							<td>{{ $user['name'] }}</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>{{ $user['email'] }}</td>
						</tr>
						<tr>
							<td>Group</td>
							<td>{{ $group['name'] }}</td>
						</tr>
						<tr>
							<td>Role</td>
							<td>{{ $role['name'] }}</td>
						</tr>
						<tr>
							<td>Created At</td>
							<td>{{ $user['created_at'] }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection