@extends('layouts.main')

@section('content')
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=331912966999050";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="container web_body">
		<div class="row">
			<div class="col-md-8">
				<div class="content_card card single_content">
					<div class="head">
						<h1 class="title">{{ $content->name_en }}</h1>
						<div class="timestamp">
							<span>{{ $content->publish_date }}</span>
						</div>
						<div class="actions">
							<i class="fa fa-share-alt"></i>
						</div>
					</div>

					<div class="body">
						<div class="content">{!! $content->body_en !!}</div>
					</div>

					<div class="comments">
						<div class="fb-comments" data-href="{{ URL::to('/'.$content->slug->name) }}" data-width="100%" data-numposts="5"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="categories card">
					<h4>კატეგორიები</h4>
					<div class="list">
						<ul>
							<li>asd</li>
							<li>asd</li>
							<li>asd</li>
							<li>asd</li>
							<li>asd</li>
							<li>asd</li>
						</ul>
						<div class="fb-share-button" data-href="{{ URL::to('/'.$content->slug->name) }}" data-layout="button_count"></div>
					</div>
				</div>
				<div class="partners_item card"></div>
				<div class="partners_item card"></div>
				<div class="partners_item card"></div>
				<div class="partners_item card"></div>
			</div>
		</div>
	</div>
@endsection