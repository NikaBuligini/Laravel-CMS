<div class="half activities-container{{ $tab == 0 ? '' : ' none' }}">
	<div class="admin-page-container">
		@foreach($activities as $key => $activity)
		<div class="admin-page-content full activity">
			<!-- <a href="#" class="user">UserName</a> -->
			<span class="time">{{ $activity->created_at->diffForHumans() }}</span>
			<p class="text">{!! $activity->text !!}</p>
		</div>
		@endforeach
	</div>
</div>