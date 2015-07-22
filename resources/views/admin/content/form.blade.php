<script type="text/javascript">
	// File Picker modification for FCK Editor v2.0 - www.fckeditor.net
	// by: Pete Forde <pete@unspace.ca> @ Unspace Interactive
	var urlobj;
	var img_upload = false;

	function BrowseServer(obj) {
		urlobj = obj;
		OpenServerBrowser('/laravel/public/media/filemanager/show', screen.width * 0.7, screen.height * 0.7);
	}

	function OpenServerBrowser(url, width, height) {
		var iLeft = (screen.width - width) / 2;
		var iTop = (screen.height - height) / 2;
		var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes";
		sOptions += ",width=" + width;
		sOptions += ",height=" + height;
		sOptions += ",left=" + iLeft;
		sOptions += ",top=" + iTop;
		var oWindow = window.open( url, "BrowseWindow", sOptions );
	}

	function SetUrl(url, width, height, alt) {
		document.getElementById(urlobj).value = url;
		// $('#' + urlobj).val(url);
		oWindow = null;

		$('#' + urlobj).focus();
		show_prewiev(url);
		img_upload = false;
	}
</script>

<div class="form-group">
	{!! Form::label('name_ka', 'Title:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::text('name_ka', $content['name_ka'], ['class' => 'form-control', 'placeholder' => 'Georgian', 'autocomplete' => 'off']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('name_en', ' ', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::text('name_en', $content['name_en'], ['class' => 'form-control', 'placeholder' => 'English', 'autocomplete' => 'off']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('name_ru', ' ', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::text('name_ru', $content['name_ru'], ['class' => 'form-control', 'placeholder' => 'Russian', 'autocomplete' => 'off']) !!}
	</div>
</div>
<div class="form-group hideable static dynamic none">
	{!! Form::label('slug', 'Slug:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::text('slug', $content['slug'] ? $content['slug']->name : '', ['class' => 'form-control', 'placeholder' => 'Slug', 'autocomplete' => 'off']) !!}
	</div>
</div>

@if ($menus)
	<div class="form-group">
		{!! Form::label('menu_id', 'Menu:', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::select('menu_id', $menus, $content['menu_id'], ['class' => 'form-control']) !!}
		</div>
	</div>
@else
	{!! Form::hidden('menu_id', $menu['id']) !!}
@endif
<div class="form-group">
	{!! Form::label('type_id', 'Type:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::select('type_id', $types, $content['type_id'], ['class' => 'form-control']) !!}
	</div>
</div>

<!-- Static Content Fields -->
<div class="form-group hideable static none">
	{!! Form::label('static_file_name', 'File name:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::text('static_file_name', $content['static_file_name'], ['class' => 'form-control', 'placeholder' => '[name].blade.php', 'autocomplete' => 'off']) !!}
	</div>
</div>

<!-- URL Content Fields -->
<div class="form-group hideable url none">
	{!! Form::label('url', 'URL:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::text('url', $content['url'], ['class' => 'form-control', 'placeholder' => 'Redirect URL', 'autocomplete' => 'off']) !!}
	</div>
</div>

<!-- Dynamic Content Fields -->
<div class="form-group hideable dynamic none">
	{!! Form::label('publish_date', 'Publish Date:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8 date">
		{!! Form::text('publish_date', $content['publish_date'], ['class' => 'form-control date', 'placeholder' => 'Content publish at']) !!}
	</div>
</div>
<div class="form-group hideable dynamic none">
	{!! Form::label('image', 'Image:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8 image_upload_field">
		{!! Form::text('image', $content['image'], ['class' => 'form-control', 'placeholder' => 'Insert/upload or paste image url', 'autocomplete' => 'off']) !!}
		<span id="image-upload-button"><i class="fa fa-picture-o"></i>Upload</span>
	</div>
</div>
<div class="form-group hideable none img_prewiev">
	{!! Form::label('image', 'Image Preview:', ['class' => 'col-sm-3 control-label']) !!}
	<div id="image-preview" class="col-sm-8"></div>
</div>
<div class="form-group hideable dynamic none">
	{!! Form::label('description_ka', 'Description Georgian:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::textarea('description_ka', $content['description_ka'], 
			['class' => 'form-control', 'placeholder' => 'Georgian', 'autocomplete' => 'off', 'rows' => '7']) !!}
	</div>
</div>
<div class="form-group hideable dynamic none">
	{!! Form::label('description_en', 'Description English:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::textarea('description_en', $content['description_en'], 
			['class' => 'form-control', 'placeholder' => 'English', 'autocomplete' => 'off', 'rows' => '7']) !!}
	</div>
</div>
<div class="form-group hideable dynamic none">
	{!! Form::label('description_ru', 'Description Russian:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::textarea('description_ru', $content['description_ru'], 
			['class' => 'form-control', 'placeholder' => 'Russian', 'autocomplete' => 'off', 'rows' => '7']) !!}
	</div>
</div>
<div class="form-group hideable dynamic none">
	{!! Form::label('body_ka', 'Body Georgian:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::textarea('body_ka', $content['body_ka'], 
			['class' => 'form-control', 'placeholder' => 'Georgian', 'autocomplete' => 'off', 'rows' => '20']) !!}
	</div>
</div>
<div class="form-group hideable dynamic none">
	{!! Form::label('body_en', 'Body English:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::textarea('body_en', $content['body_en'], 
			['class' => 'form-control', 'placeholder' => 'English', 'autocomplete' => 'off', 'rows' => '20']) !!}
	</div>
</div>
<div class="form-group hideable dynamic none">
	{!! Form::label('body_ru', 'Body Russian:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8">
		{!! Form::textarea('body_ru', $content['body_ru'], 
			['class' => 'form-control', 'placeholder' => 'Russian', 'autocomplete' => 'off', 'rows' => '20']) !!}
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-8">
		{!! Form::submit($button_text, ['class' => 'btn btn-primary form-control']) !!}
	</div>
</div>

<script>
	tinymce.init({
		selector:'textarea',
		file_browser_callback: function(field_name, url, type, win) {
			img_upload = true;
			BrowseServer(field_name);
		},
		menubar: false,
		plugins: 'link image textcolor searchreplace code fullscreen insertdatetime media table template charmap print preview media',
		toolbar: [
			'undo redo newdocument formatselect fontselect fontsizeselect code fullscreen',
			'bold italic underline forecolor backcolor alignleft aligncenter alignright alignjustify bullist numlist outdent indent removeformat',
			'link image media searchreplace insertdatetime table template print preview',
		],
		// link_list: [
		// 	{title: 'My page 1', value: 'http://www.tinymce.com'},
		// 	{title: 'My page 2', value: 'http://www.moxiecode.com'}
		// ]
	});

	$('#image-upload-button').click(function() {
		BrowseServer('image');
	});

	$('#image').on('change keyup paste', function() {
		var value = $(this).val();
		console.log(value);
		// $('#image-preview').html('<img src="' + $(this).val() + '" />');
		if (value.length != 0) {
			show_prewiev(value);
		} else {
			hide_prewiev();
		}
	});

	function show_prewiev(src) {
		if (src.length != 0 && !img_upload) {
			$('.img_prewiev').removeClass('none');
			$('#image-preview').html('<img src="' + src + '" />');
		}
	}

	function hide_prewiev() {
		$('.img_prewiev').addClass('none');
		$('#image-preview').html('');
	}

	if ($('#image').val().length != 0) {
		show_prewiev($('#image').val());
	}
</script>