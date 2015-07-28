@extends('layouts.main')

@section('content')
	<div class="container web_body">
		<div class="row">
			<div class="col-md-8">
				<div class="contents_container">
					@foreach($contents as $content)
					<div class="content_card card item">
						<div class="content_main_img">
							<img src="{{ $content->image }}">
						</div>
						<div class="content_description">
							<div class="supporting_text">
								<h1>{{ $content->name_en }}</h1>
								<div class="body">
									{!! $content->description_en !!}
								</div>
							</div>
						</div>
						<div class="actions">
							<a href="{{ URL::to('/'.$content->slug->name) }}" class="read_more_btn">Read more</a>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			
			@include('main/partials/right_pannel')
		</div>
	</div>
@endsection