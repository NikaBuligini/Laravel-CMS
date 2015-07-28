<div id="left-nav-container" class="left-nav {{ $theme['left_nav_class'] }}">
	<div class="logo-header">
		<a href="{{ URL::to('admin/user/'.$theme['auth']->id) }}">
			<img src="{{ $theme['user-profile-image'] }}">
		</a>
	</div>

	<nav class="main-navigation">
		<ul>
			<li>
				<a href="#">
					<div class="logo"><i class="fa fa-dashboard"></i></div>
					<span>Dashboard</span>
				</a>
			</li>
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
				<a href="{{ action('Admin\SettingController@index') }}">
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
			<!-- <li>
				<a href="#">
					<div class="logo"><i class="fa fa-tasks"></i></div>
					<span>Tasks</span>
				</a>
			</li> -->
			<li>
				<a href="{{ action('Admin\CarouselController@index') }}">
					<div class="logo"><i class="fa fa-dashcube"></i></div>
					<span>Slider</span>
				</a>
			</li>
			<li>
				<a href="{{ action('Admin\BannerController@index') }}">
					<div class="logo"><i class="fa fa-align-justify"></i></div>
					<span>Banners</span>
				</a>
			</li>
			<li>
				<a href="{{ action('Admin\FileManagerController@index') }}">
					<div class="logo"><i class="fa fa-folder-open"></i></div>
					<span>File Manager</span>
				</a>
			</li>
		</ul>
	</nav>
</div>