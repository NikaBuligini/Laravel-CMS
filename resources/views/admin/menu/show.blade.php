@extends('layouts.admin')

@section('content')
	<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

	<div class="two-from-three float-left-section">
		<div class="admin-page-container full">
			<div class="admin-page-content">
				<a href="{{ action('Admin\ContentController@create', ['menu' => $menu['id']]) }}" class="btn green-btn">
					<i class="fa fa-plus"></i><span>Create new content</span>
				</a>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="column-id">ID</th>
							<th>Name</th>
							<th>Type</th>
							<th class="column-date">Publish date</th>
							<th class="column-date">Created at</th>
							<th class="column-action">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($contents as $key => $content)
							<tr>
								<td>{{ $content['id'] }}</td>
								<td>{{ $content['name_ka'] }}</td>
								<td>{{ $content->type->name }}</td>
								<td>{{ $content['publish_date'] }}</td>
								<td>{{ $content['created_at'] }}</td>
								<td class="actions-column">
									<div class="actions-container">
										<div class="actions">
											<a href="{{ action('Admin\ContentController@show', ['content' => $content['id']]) }}" class="green-btn button" title="View">
												<i class="fa fa-search"></i>
											</a>
											<a href="{{ action('Admin\ContentController@edit', ['content' => $content['id']]) }}" class="blue-btn button" title="Edit">
												<i class="fa fa-pencil-square-o"></i>
											</a>
											<a href="{{ action('Admin\ContentController@destroy', ['content' => $content['id']]) }}" class="red-btn button" title="Delete">
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

	<div class="one-from-three float-left-section">
		<div class="admin-page-container full">
			<div class="admin-page-content">
				<div id="list" class="sorable-list" data-id="{{ $menu->id }}" data-location="{{ $menu->location_id }}"></div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="{{ asset('/js/menu.js') }}"></script>
@endsection