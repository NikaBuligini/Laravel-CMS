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
			</div>
		</div>
	</div>
</nav>