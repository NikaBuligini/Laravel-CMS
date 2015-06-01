<div class="half activities-container{{ $tab == 0 ? '' : ' none' }}">
	<div class="admin-page-container">
		@foreach($activities as $key => $activity)
		<div class="admin-page-content full activity">
			<!-- <a href="#" class="user">UserName</a> -->
			<div class="image">
				<a href="{{ URL::to('admin/user/'.$activity->user_id) }}">
					<img src="{{ URL::to('images/users/'.$activity->user_id.'/profile.jpg') }}">
				</a>
			</div>
			<div class="content">
				<span class="time">{{ $activity->created_at->diffForHumans() }}</span>
				<p class="text">{!! $activity->text !!}</p>
			</div>
		</div>
		@endforeach
	</div>
</div>