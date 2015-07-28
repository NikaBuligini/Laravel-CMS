@extends('layouts.admin')

@section('content')
	<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pannel">
						<a href="banner/create" class="btn green-btn">
							<i class="fa fa-plus"></i><span>Create</span>
						</a>
						<a href="banner/saveOrder" id="save" class="btn green-btn" disabled="disabled">
							<i class="fa fa-save"></i><span>Save order</span>
						</a>
					</div>
					<ul class="banners">
						@if ($banners)
							@foreach($banners as $banner)
								<li class="item card" data-id="{{ $banner['id'] }}">
									<img src="{{ $banner['image'] }}" title="{{ $banner['name'] }}">
									<div class="actions">
										<div class="line">
											<label for="name">Name:</label>
											<span>{{ $banner['name'] }}</span>
										</div>
										<div class="line">
											<label for="url">URL:</label>
											<a href="{{ $banner['url'] }}" target="_blank">link</a>
										</div>
										<div class="line tools">
											<a href="{{ action('Admin\BannerController@edit', ['banner' => $banner['id']]) }}" class="blue button" title="Edit">
												<i class="fa fa-pencil-square-o"></i>
											</a>
											<a href="{{ action('Admin\BannerController@destroy', ['banner' => $banner['id']]) }}" class="red button" title="Delete">
												<i class="fa fa-trash-o"></i>
											</a>
										</div>
									</div>
								</li>
							@endforeach
						@endif
					</ul>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript" src="{{ asset('/js/banners.js') }}"></script>
@endsection