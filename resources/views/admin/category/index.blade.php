@extends('layouts.admin')

@section('content')
	<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pannel categories_pannel">
						<a href="category/create" class="btn green-btn">
							<i class="fa fa-plus"></i><span>Create</span>
						</a>
						<a href="category/saveOrder" id="save" class="btn green-btn" disabled="disabled">
							<i class="fa fa-save"></i><span>Save order</span>
						</a>
					</div>

					<ul class="categories">
						<li class="item card" data-id="1">
							<div class="dd-handle">
								<i class="fa fa-arrows"></i>
							</div>
							<span>asd</span>
							<div class="pull-right">
								<!-- {{ action('Admin\BannerController@edit', ['banner' => 1]) }} -->
								<a href="http://localhost:8081/laravel/public/admin/menu/1">
									<i class="fa fa-eye view_toggle" rel="1"></i>
								</a> | 
								<a href="http://localhost:8081/laravel/public/admin/menu/1/edit">
									<i class="fa fa-pencil edit_toggle" rel="1"></i>
								</a> | 
								<i class="fa fa-times delete_toggle remove" rel="1"></i>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			var needsUpdate = false;

			$('.categories').sortable({
				revert: false,
				handle: '.dd-handle',
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

				var order = $('.categories').sortable('toArray', {attribute: 'data-id'});

				$.post(url_head + '/public/admin/categories/updateOrder', {order: order},
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

				$.post(url_head + '/public/admin/categories/ajaxDestroy', {item_id: elem.attr('data-id')}, function(data) {
					if (data.success) {
						elem.closest('li').remove();
						show_alert('success', 'Category has been deleted')
					} else {
						show_alert('error', 'Failed to delete category');
					}
				});
			});
		});
	</script>
@endsection