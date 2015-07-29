@extends('layouts.admin')

@section('content')
	<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pannel carousel_pannel">
						<a href="carousel/create" class="btn green-btn">
							<i class="fa fa-plus"></i><span>Create</span>
						</a>
						<a href="carousel/saveOrder" id="save" class="btn green-btn" disabled="disabled">
							<i class="fa fa-save"></i><span>Save order</span>
						</a>
					</div>
					<ul class="carousels">
						@if($carousels)
							@foreach($carousels as $item)
							<li class="item card" data-id="{{ $item['id'] }}">
								<img src="{{ $item['image'] }}">
								<div class="actions">
									<i class="fa fa-remove remove"></i>
								</div>
							</li>
							@endforeach
						@else
							<li class="item card" data-id="0">
								{!! Html::image('uploads/images/slider/red.jpg') !!}
								<div class="actions">
									<i class="fa fa-remove remove"></i>
								</div>
							</li>
							<li class="item card" data-id="0">
								{!! Html::image('uploads/images/slider/purple.jpg') !!}
								<div class="actions">
									<i class="fa fa-remove remove"></i>
								</div>
							</li>
							<li class="item card" data-id="0">
								{!! Html::image('uploads/images/slider/blue.jpg') !!}
								<div class="actions">
									<i class="fa fa-remove remove"></i>
								</div>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			var needsUpdate = false;

			$('.carousels').sortable({
				revert: false,
				handle: 'img',
				placeholder: 'dd-highlight',
				cursor: '-webkit-grabbing',
				opacity: 0.8,
				helper: 'clone',
				scroll: false,
				update: function(event, ui) {
					needsUpdate = true;
					$('#save').removeAttr('disabled');
				}
			});

			$('#save').click(function(event) {
				event.preventDefault();

				var order = $('.carousels').sortable('toArray', {attribute: 'data-id'});

				$.post(url_head + '/public/admin/carousel/updateOrder', {order: order},
					function(data) {
						if (data.success) {
							show_alert('success', data.message);

							needsUpdate = false;
							$('#save').attr('disabled', 'disabled');
						} else {
							show_alert('error', "Something went wrong. Update didn't happened");
						}
					}
				);
			});

			$('.remove').click(function() {
				var elem = $(this).closest('li');

				$.post(url_head + '/public/admin/carousel/ajaxDestroy', {item_id: elem.attr('data-id')}, function(data) {
					if (data.success) {
						elem.closest('li').remove();
						show_alert('success', 'Image has been deleted')
					} else {
						show_alert('error', 'Failed to delete image');
					}
				});
			});
		});
	</script>
@endsection