<div id="left-nav-container" class="left-nav {{ $theme['left_nav_class'] }}">
	<div class="logo-header">
		<a href="{{ URL::to('admin/home') }}">
			<img src="{{ $theme['user-profile-image'] }}">
		</a>
	</div>

	<nav class="main-navigation">
		<ul>
			<li>
				<a href="{{ action('Admin\MenuController@index') }}">
					<div class="logo"><i class="fa fa-sitemap"></i></div>
					<span>Menu Management</span>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="logo"><i class="fa fa-files-o"></i></div>
					<span>Pages Management</span>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="logo"><i class="fa fa-cogs"></i></div>
					<span>Settings</span>
				</a>
			</li>
			<li>
				<a href="{{ action('Admin\GroupController@index') }}">
					<div class="logo"><i class="fa fa-users"></i></div>
					<span>Groups</span>
				</a>
			</li>
			<li>
				<a href="{{ action('Admin\UserController@index') }}">
					<div class="logo"><i class="fa fa-user"></i></div>
					<span>Users</span>
				</a>
			</li>
		</ul>
	</nav>
</div>