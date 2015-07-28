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
	@foreach($web->banners() as $banner)
		<div class="partners_item card">
			<a href="{{ $banner->url }}" target="_blank">
				<img src="{{ $banner->image }}" title="{{ $banner->name }}">
			</a>
		</div>
	@endforeach
</div>