@if(isset($theme['title']) && isset($theme['description']))
	<div class="page-header">
		<h3>{{ $theme['title'] }}</h3>
		<span>{{ $theme['description'] }}</span>
	</div>
@endif