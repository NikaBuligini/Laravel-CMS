@extends('layouts.admin')

@section('content')
	<script src="{{ asset('/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>

	<div class="admin-page-container three-fourth">
		<div class="admin-page-content">
			{!! Form::open(array('url' => '/admin/content', 'method' => 'post', 'class' => 'form-horizontal')) !!}
				@include('admin/content/form')
			{!! Form::close() !!}

			@if($errors->any())
				<ul class="alert alert-danger">
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			@endif
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#type_id').change(function(event) {
				changeType($(this));
			});

			function changeType(elem) {
				$('.hideable').addClass('none');
				switch(elem.val()) {
					case '0': break;
					case '1':
						$('.static').removeClass('none');
						break;
					case '2':
						$('.dynamic').removeClass('none');
						break;
					case '3':
						$('.url').removeClass('none');
						break;
					default:
						alert('Invalid type');
				}
			}

			changeType($('#type_id'));

			$('.date .form-control.date').datepicker({
				autoclose: true,
				format: 'mm/dd/yyyy',
				language: 'ka',
				todayHighlight: true
			});
		});
	</script>
@endsection