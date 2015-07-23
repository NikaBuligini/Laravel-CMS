<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="footer_section_container">
					@if($web->getFooterMenus())
						<?php $width = (int)(12 / count($web->getFooterMenus())); ?>
						@foreach($web->getFooterMenus() as $menu)
						<div class="col-md-{{ $width }} section">
							<h1 class="heading">{{ $menu->name_en }}</h1>
							<ul>
								@foreach($menu->children()->get() as $child)
								<li class="item">{{ $child->name_en }}</li>
								@endforeach
							</ul>
						</div>
						@endforeach
					@endif
				</div>
				<div class="bottom_section">
					<ul>
						<li>asd</li>
						<li>asd</li>
						<li>asd</li>
						<li>asd</li>
						<li><a href="#">ქართული</a></li>
						<li><a href="#">English</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>