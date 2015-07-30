@extends('layouts.main')

@section('content')
	<div class="container web_body">
		<div class="row">
			<div class="col-md-8 home_carousel">
				@include('main/partials/main_slider')
			</div>
			<div class="col-md-4 news_feed_container">
				<div class="news_feed">
					@foreach($feed as $news)
					<div class="item">
						<a href="{{ URL::to('/'.$news->slug->name) }}">
							<div class="news_feed_img">
								<img src="{{ $news['image'] }}">
							</div>
							<div class="content">
								<span class="timestamp">{{ $news['publish_date'] }}</span>
								<div class="news">
									{!! $news['description_ka'] !!}
								</div>
							</div>
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="row middle_row">
			<div class="col-md-8">
				<div class="partners_slider_card card noselect">
					@include('main/partials/partners_slider')
				</div>

				<div class="content_card card"></div>
			</div>

			@include('main/partials/right_pannel')
		</div>
	</div>
@endsection