@extends('layouts.main')

@section('content')
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