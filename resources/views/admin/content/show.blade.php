@extends('layouts.admin')

@section('content')
	<div class="admin-page-container three-fourth">
		<div class="admin-page-content">
			<table class="table table-bordered show-table">
				<tbody>
					<tr class="active">
						<td>ID</td>
						<td>{{ $content['id'] }}</td>
					</tr>

					<tr>
						<td>Type</td>
						<td>{{ $content->type->name }}</td>
					</tr>

					@if($type['id'] == $type->static_type || $type['id'] == $type->dynamic_type)
						<tr>
							<td>View on web <i class="fa fa-search"></i></td>
							<td><a href="{{ $content->slug->link() }}" target="_blank">{{ $content->slug->name }}</a></td>
						</tr>

						<tr>
							<td>Title (Geo)</td>
							<td>{{ $content['name_ka'] }}</td>
						</tr>
						<tr>
							<td>(Eng)</td>
							<td>{{ $content['name_en'] }}</td>
						</tr>
						<tr>
							<td>(Rus)</td>
							<td>{{ $content['name_ru'] }}</td>
						</tr>
						<tr>
							<td>Slug</td>
							<td>{{ '/'.$content['slug']->name }}</td>
						</tr>
					@endif

					@if($type['id'] == $type->static_type)
						<tr>
							<td>Static page name</td>
							<td>{{ $content['static_file_name'] }}</td>
						</tr>
					@endif

					@if($type['id'] == $type->url_type)
						<tr>
							<td>URL</td>
							<td><a href="{{ $content['url'] }}" target="_blank">{{ $content['url'] }}</a></td>
						</tr>
					@endif

					@if($type['id'] == $type->dynamic_type)
						<tr>
							<td>Publish date</td>
							<td>{{ $content['publish_date'] }}</td>
						</tr>

						@if($content['image'])
						<tr>
							<td>Image preview</td>
							<td><img class="admin_content_image_preview" src="{{ $content['image'] }}" title="{{ $content['image'] }}"></td>
						</tr>
						@endif

						<tr>
							<td>Description (Geo)</td>
							<td>{!! $content['description_ka'] !!}</td>
						</tr>
						<tr>
							<td>(Eng)</td>
							<td>{!! $content['description_en'] !!}</td>
						</tr>
						<tr>
							<td>(Rus)</td>
							<td>{!! $content['description_ru'] !!}</td>
						</tr>

						<tr>
							<td>Body (Geo)</td>
							<td>{!! $content['body_ka'] !!}</td>
						</tr>
						<tr>
							<td>(Eng)</td>
							<td>{!! $content['body_en'] !!}</td>
						</tr>
						<tr>
							<td>(Rus)</td>
							<td>{!! $content['body_ru'] !!}</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
@endsection