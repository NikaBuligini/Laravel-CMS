<!-- <div class="images_container">
	<div class="content">
		<div class="item">
			<a href="#">
				<img src="http://localhost:8081/laravel/public/media/filemanager/userfiles/thrall.png">
			</a>
		</div>
	</div>
</div> -->

<div class="side left none">
	<i class="fa fa-chevron-left" data-dirrection="left"></i>
</div>
<div class="side right none">
	<i class="fa fa-chevron-right" data-dirrection="right"></i>
</div>

@if(!$web->partners()->isEmpty())
<div class="partners_slider_card card noselect">
	<div class="owl-carousel">
		@foreach($web->partners() as $partner)
		<div class="slider_item">
			<a href="{{ $partner->url }}" target="_blank">
				<img src="{{ $partner->image }}" title="{{ $partner->name }}">
			</a>
		</div>
		@endforeach
	</div>

	<script type="text/javascript" src="{{ asset('/js/partners.js') }}"></script>
</div>
@endif
