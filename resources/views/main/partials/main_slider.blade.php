<div id="carousel-example-generic" class="carousel slide card" data-ride="carousel">
	@if(!$web->carousel()->isEmpty())
		<ol class="carousel-indicators">
			<?php $count = 0; ?>
			@foreach($web->carousel() as $item)
				<li data-target="#carousel-example-generic" 
					class="{{ $count == 0 ? 'active' : ''}}"
					data-slide-to="{{ $count++ }}"></li>
			@endforeach
		</ol>

		<div class="carousel-inner" role="listbox">
			<?php $count = 0; ?>
			@foreach($web->carousel() as $item)
				<div class="item {{ $count++ == 0 ? 'active' : '' }}">
					<img src="{{ $item['image'] }}">
				</div>
			@endforeach
		</div>
	@else
		@include('main/templates/carousel_default_items')
	@endif

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