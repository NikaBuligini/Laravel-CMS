<div class="row">
	<nav class="navbar navbar-static-top header-menu">
		<div class="closer-container">
			<a id="layout-button" href="javascript:void(0)" class="navbar-minimalize minimalize-btn btn btn-primary">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		@if(Session::has('flash_message') && !Session::has('flash_secondary'))
			<div class="main-alert-container">
				<div class="main-alert-content">
					@if(Session::has('flash_success'))
						<i class="fa fa-check"></i>
					@endif
					{!! Session::get('flash_message') !!}
				</div>
			</div>
		@endif
		<ul class="nav navbar-top-links navbar-right">
			<li class="dropdown">
				<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-desktop"></i>
					<span>Control Panel</span>
					<i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li>
						<a href="#">
							<i class="fa fa-wrench"></i>
							<span>Settings</span>
						</a>
					</li>
					<li>
						<a href="{{ url('/admin/user') }}">
							<i class="fa fa-user"></i>
							<span>User</span>
						</a>
					</li>
					<li>
						<a href="{{ url('/admin/group') }}">
							<i class="fa fa-users"></i>
							<span>Groups</span>
						</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="#">
							<i class="fa fa-files-o"></i>
							<span>Pages</span>
						</a>
					</li>
					<li>
						<a href="{{ url('/admin/menu') }}">
							<i class="fa fa-sitemap"></i>
							<span>Menu</span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-user"></i>
					<span>{{ $theme['user-name'] }}</span>
					<i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li>
						<a href="#">
							<i class="fa fa-user"></i>
							<span>Profile</span>
						</a>
						<li>
						<a href="{{ url('/admin/auth/logout') }}">
							<i class="fa fa-sign-out"></i>
							<span>Logout</span>
						</a>
					</li>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
</div>