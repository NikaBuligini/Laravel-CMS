<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Laravel</title>

	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap-theme.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/om.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body class="calculate">
	<div class="container">
		<div class="row">
			<div class="content">
				{!! Form::open(array('url' => '/postCalculate', 'method' => 'post')) !!}
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Mon</th>
								<th>Tue</th>
								<th>Wed</th>
								<th>Thu</th>
								<th>Fri</th>
								<th>Sat</th>
								<th>Sun</th>
							</tr>
						</thead>
						<tbody>
							<tr class="input-row">
								<td><input type="text" class="form-control inp" name="Monday" /></td>
								<td><input type="text" class="form-control inp" name="Tuesday" /></td>
								<td><input type="text" class="form-control inp" name="Wednesday" /></td>
								<td><input type="text" class="form-control inp" name="Thursday" /></td>
								<td><input type="text" class="form-control inp" name="Friday" /></td>
								<td><input type="text" class="form-control inp" name="Saturday" /></td>
								<td><input type="text" class="form-control inp" name="Sunday" /></td>
							</tr>
						</tbody>
					</table>
					<div class="form-config">
						<div class="control-group">
							<input type="checkbox" name="debug" class="debug-box" /> debug
						</div>
						<div class="control-group">
							<input type="checkbox" name="xdebug" class="debug-box" /> steps
						</div>
						<div class="control-group">
							<button type="reset" name="reset" class="reset"><i class="fa fa-refresh"></i></button>
						</div>
					</div>
				{!! Form::close() !!}

				<div id="table"></div>
			</div>
		</div>
	</div>
	<!-- Scripts -->

	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>

	<script type="text/javascript">
		function submit_form() {
			var inputs = $('.inp').toArray();
			var valid = true;

			for (var i = 0; i < inputs.length; i++) {
				valid = valid && ($(inputs[i]).val().length > 0)
			}

			if (valid || $('#table').attr('filled') == 'true') {
				$.post('/laravel/public/postCalculate?' + $('form').serialize(), function(data) {
					$('#table').html(data).attr('filled', 'true');
				})
			}
		}

		$('.inp').keyup(function() {
			submit_form();
		});

		$('.debug-box').change(function() {
			submit_form();
		});

		$('.reset').click(function(e) {
			$('#table').html('').attr('filled', 'false');
			var icon = $(this).find('i').addClass('fa-spin');
			setTimeout(function() {
				icon.removeClass('fa-spin');
			}, 1000);
		});
	</script>
</body>
</html>