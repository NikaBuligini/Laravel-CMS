@extends('layouts.main')

@section('content')
	<div class="container web_body">
		<div class="row">
			<div class="col-md-8 home_carousel">
				<div id="carousel-example-generic" class="carousel slide card" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							{!! Html::image('uploads/images/slider/red.jpg') !!}
							<!--<div class="carousel-caption"></div>-->
						</div>
						<div class="item">
							{!! Html::image('uploads/images/slider/purple.jpg') !!}
						</div>
						<div class="item">
							{!! Html::image('uploads/images/slider/blue.jpg') !!}
						</div>
					</div>

					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
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
				<div class="content_card card"></div>
			</div>

			@include('main/partials/right_pannel')
		</div>
	</div>
@endsection