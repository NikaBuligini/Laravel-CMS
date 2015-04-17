<div class="half{{ $tab == 1 ? '' : ' none' }}">
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
						<td>Status</td>
						<td>{{ $user['active'] == 1 ? 'Active' : 'Blocked' }}</td>
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