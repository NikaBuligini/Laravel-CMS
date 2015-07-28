@extends('layouts.admin')

@section('content')
	<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

	<div class="admin-page-container three-fourth">
		<div class="admin-page-content">
			<a href="group/create" class="btn green-btn">
				<i class="fa fa-plus"></i><span>Create</span>
			</a>

			<ul class="carousel_container">
				<li>{!! Html::image('uploads/images/slider/red.jpg') !!}</li>
				<li>{!! Html::image('uploads/images/slider/purple.jpg') !!}</li>
				<li>{!! Html::image('uploads/images/slider/blue.jpg') !!}</li>
			</ul>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.carousel_container').sortable({
				revert: false,
				handle: 'img',
				placeholder: 'dd-highlight',
				cursor: '-webkit-grabbing',
				opacity: 0.8,
				helper: 'clone',
				scroll: false
			});
		});
	</script>
@endsection