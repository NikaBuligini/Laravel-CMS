<div class="images_container">
	<div class="content">
		<div class="item">
			<a href="#">
				<img src="http://localhost:8081/laravel/public/media/filemanager/userfiles/thrall.png">
			</a>
		</div>
		<div class="item">
			<a href="#">
				<img src="http://localhost:8081/laravel/public/media/filemanager/userfiles/punisher-header.jpg">
			</a>
		</div>
		<div class="item">
			<a href="#">
				<img src="http://localhost:8081/laravel/public/media/filemanager/userfiles/deadpool.jpg">
			</a>
		</div>
		<div class="item">
			<a href="#">
				<img src="http://localhost:8081/laravel/public/media/filemanager/userfiles/thrall.png">
			</a>
		</div>
		<div class="item">
			<a href="#">
				<img src="http://localhost:8081/laravel/public/media/filemanager/userfiles/punisher-header.jpg">
			</a>
		</div>
		<div class="item">
			<a href="#">
				<img src="http://localhost:8081/laravel/public/media/filemanager/userfiles/deadpool.jpg">
			</a>
		</div>
	</div>
</div>

<div class="side left none">
	<i class="fa fa-chevron-left" data-dirrection="left"></i>
</div>
<div class="side right none">
	<i class="fa fa-chevron-right" data-dirrection="right"></i>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var oldWidth = 0;
		var itemWidth = 0;

		adjustSliderItems();

		$(window).resize(function(event) {
			adjustSliderItems();
		});

		var sliderItemsCount = $('.images_container .item').length;
		var sliderIndex = 1;
		var ready = true;

		updateArrowsVisibility();

		$('.partners_slider_card .fa').mousedown(function() {
			if (!ready) return;

			ready = false;

			var dirrection = $(this).attr('data-dirrection');
			var left = parseInt($('.images_container .content').css('left'));

			var changeWidth = (($('.images_container').width() / 3) | 0);

			if (dirrection == 'left') {
				$('.images_container .content').css('left', left + changeWidth);
				sliderIndex--;
			} else if (dirrection == 'right') {
				$('.images_container .content').css('left', left - changeWidth);
				sliderIndex++;
			}

			updateArrowsVisibility();

			setTimeout(function() {
				ready = true;
			}, 300);
		});

		function adjustSliderItems() {
			var slider = $('.images_container');
			var newWidth = slider.width();

			if (newWidth != oldWidth) {
				itemsWidth = ((newWidth / 3) | 0) - 15;

				slider.find('.item').each(function(index) {
					$(this).width(itemsWidth);
				});

				if (typeof sliderIndex !== 'undefined' && sliderIndex > 1) {
					$('.images_container .content').css(
						'left', (sliderIndex - 1) * ((newWidth / 3) | 0) * -1);
				};

				oldWidth = newWidth;
			}
		}

		function updateArrowsVisibility() {
			if (sliderItemsCount < 4) {
				return;
			}

			if (sliderIndex == 1) {
				$('.partners_slider_card .left').addClass('none');
			} else {
				$('.partners_slider_card .left').removeClass('none');
			}
			if (sliderIndex == sliderItemsCount - 2) {
				$('.partners_slider_card .right').addClass('none');
			} else {
				$('.partners_slider_card .right').removeClass('none');
			}
		}
	});
</script>