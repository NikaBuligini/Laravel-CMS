@extends('layouts.admin')

@section('content')
	<div class="admin-page-container">
		<div class="admin-page-content full">
			<a href="group/create" class="btn green-btn">
				<i class="fa fa-plus"></i><span>Create</span>
			</a>
			<div class="table-responsive">
				@if(Session::has('flash_message'))
					<div class="group-alert alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
						@if(Session::has('flash_message_important'))
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						@endif

						{{ Session::get('flash_message') }}
					</div>
				@endif

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="column-id">#</th>
							<th>Name</th>
							<th>Role</th>
							<th class="column-date">Created at</th>
							<th class="column-date">Updated at</th>
							<th class="column-action">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($groups as $key => $group)
							<tr>
								<td>{{ $count++ }}</td>
								<td>{{ $group['name'] }}</td>
								<td>{{ $group->role['name'] }}</td>
								<td>{{ $group['created_at']->diffForHumans() }}</td>
								<td>{{ $group['updated_at']->diffForHumans() }}</td>
								<td class="actions-column">
									<div class="actions-container">
										<div class="actions">
											<a href="{{ action('Admin\GroupController@show', ['group' => $group['id']]) }}" class="green-btn button" title="View">
												<i class="fa fa-search"></i>
											</a>
											<a href="{{ action('Admin\GroupController@edit', ['group' => $group['id']]) }}" class="blue-btn button" title="Edit">
												<i class="fa fa-pencil-square-o"></i>
											</a>
											<a href="{{ action('Admin\GroupController@destroy', ['group' => $group['id']]) }}" class="red-btn button" title="Delete">
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

	<script>
		$('div.alert').not('.alert-important').delay(3000).slideUp(300);
	</script>
@endsection