@if($schedule)
<table class="table table-bordered table-hover answer">
	<thead>
		<tr>
			<th>#</th>
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thu</th>
			<th>Fri</th>
			<th>Sat</th>
			<th>Sun</th>
		</tr>
	</thead>
	<tbody class="result">
		@foreach($schedule->workers as $key => $employee)
			@if($debug)
				<tr>
					<td></td>
					{!! $employee->html_debug !!}
				</tr>
			@endif
			<tr>
				<td>{{ $key + 1 }}</td>
				{!! $employee->html !!}
			</tr>
		@endforeach
	</tbody>
</table>
<div class="total-result">
	@foreach($schedule->workers as $worker)
		@if (rand(0, 1) == 1)
			<i class="fa fa-male"></i>
		@else
			<i class="fa fa-female"></i>
		@endif
	@endforeach
	<span>= {{ count($schedule->workers) }} employed</span>
</div>
@else
<div class="alert alert-warning" role="alert">
	<h3>No workers for you!</h3>
	<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
</div>
@endif