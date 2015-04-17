@extends('layouts.admin')

@section('content')
	<div class="profile-header">
		<div class="image-container">
			<img src="{{ $theme['user-profile-image'] }}">
		</div>
		
		<div class="menu-container">
			<nav class="menu">
				<a href="?tab=activities" content="activities" {{ $tab == 0 ? 'class=active' : '' }}>Activities</a>
				<a href="?tab=about" content="about" {{ $tab == 1 ? 'class=active' : '' }}>About</a>
				<a href="?tab=edit" content="edit" {{ $tab == 2 ? 'class=active' : '' }}>Edit</a>
			</nav>
			<nav class="actions">
				@if($user->active)
					<a href="{{ action('Admin\UserController@block', ['user' => $user['id']]) }}" class="red-btn button" title="Block">
						<i class="fa fa-lock"></i>
					</a>
				@else
					<a href="{{ action('Admin\UserController@unblock', ['user' => $user['id']]) }}" class="small-red-btn button" title="Unblock">
						<i class="fa fa-unlock"></i>
					</a>
				@endif
			</nav>
		</div>
	</div>

	<section>
		@include('admin/user/partials/activities')
		@include('admin/user/partials/about')
		@include('admin/user/partials/edit')
	</section>
@endsection