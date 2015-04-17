@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content full">
			<a href="user/create" class="btn green-btn">
				<i class="fa fa-plus"></i><span>Generate Registration Link</span>
			</a>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="column-id">#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Group</th>
							<th class="column-date">Created at</th>
							<th class="column-date">Updated at</th>
							<th class="column-action">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $key => $user)
							<tr>
								<td>{{ $count++ }}</td>
								<td>{{ $user['name'] }}</td>
								<td>{{ $user['email'] }}</td>
								<td>{{ $user->group['name'] }}</td>
								<td>{{ $user['created_at']->diffForHumans() }}</td>
								<td>{{ $user['updated_at']->diffForHumans() }}</td>
								<td class="actions-column">
									<div class="actions-container">
										<div class="actions">
											<a href="{{ action('Admin\UserController@show', ['user' => $user['id']]) }}" class="green-btn button" title="View">
												<i class="fa fa-search"></i>
											</a>
											<a href="{{ action('Admin\UserController@edit', ['user' => $user['id']]) }}" class="blue-btn button" title="Edit">
												<i class="fa fa-pencil-square-o"></i>
											</a>
											@if($user->active)
												<a href="{{ action('Admin\UserController@block', ['user' => $user['id']]) }}" class="red-btn button" title="Block">
													<i class="fa fa-lock"></i>
												</a>
											@else
												<a href="{{ action('Admin\UserController@unblock', ['user' => $user['id']]) }}" class="small-red-btn button" title="Unblock">
													<i class="fa fa-unlock"></i>
												</a>
											@endif
											<a href="{{ action('Admin\UserController@destroy', ['user' => $user['id']]) }}" class="red-btn button" title="Delete">
												<i class="fa fa-trash-o"></i>
											</a>
										</div>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection