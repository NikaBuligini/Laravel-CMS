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
{!! Form::hidden('menu_id', $menu['id']) !!}
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
</script>