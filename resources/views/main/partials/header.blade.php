<nav class="navbar-fixed-top navbar_top" role="navigation">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="main_logo">
					<a href="/">
						<span>Logo</span>
					</a>
				</div>
				<ul class="menuH">
					{!! $web->renderMenus($web->getHeaderMenus()) !!}
				</ul>
				
				<div class="social_media_icons">
					<div class="social_media set squared bg-fall fg-rise fg-color">
						{!! $web->getURL('facebook') !!}
						{!! $web->getURL('google_p') !!}
						{!! $web->getURL('twitter') !!}
						{!! $web->getURL('youtube') !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>