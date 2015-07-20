@extends('layouts.admin')

@section('content')
	<iframe src="{{ url('media/filemanager/show') }}" class="filemanager"></iframe>
@endsection