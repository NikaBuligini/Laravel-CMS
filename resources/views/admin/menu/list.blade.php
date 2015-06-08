<div>
	<a href="{{ url('admin/menu/create?parent='.$parent->id.'&location='.$parent->location_id) }}" 
		class="btn green-btn"><i class="fa fa-plus"></i></a>
	<button id="new-header" type="button" class="btn green-btn" data-toggle="modal" data-target=".bs-new-header-modal-lg">Add</button>
</div>

@if($list)
<div id="header-list" class="menu-builder-container noselect">
	<ol class="dd-list" data-id="{{ $parent->id }}">
	@foreach($list as $item)
		<li id="node {{ $item->order }}" class="dd-item nested-list-item" data-order="{{ $item->order }}" data-id="{{ $item->id }}">
			<div class="nested-list-content">
				<div class="dd-handle nested-list-handle {{ $item->status_id == $canceled_id ? ' canceled' : '' }}">
					<i class="fa fa-arrows"></i>
				</div>
				<span>{{ $item->name_en }}</span>
				<div class="pull-right">
					<a href="{{ url('admin/menu/'.$item->id) }}">
						<i class="fa fa-eye view_toggle" rel="{{ $item->id }}"></i>
					</a> | 
					<a href="{{ url('admin/menu/edit/'.$item->id) }}">
						<i class="fa fa-pencil edit_toggle" rel="{{ $item->id }}"></i>
					</a> | 
					<i class="fa fa-times delete_toggle" rel="{{ $item->id }}"></i>
				</div>
			</div>
		</li>
	@endforeach
	</ol>
	<button type="button" class="btn green-btn save" data-target="{{ $parent->location_id }}">Save</button>
</div>
@else
	<span>Sorry, there was no menu.</span>
@endif