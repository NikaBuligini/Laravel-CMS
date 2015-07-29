<script type="text/javascript">
	// File Picker modification for FCK Editor v2.0 - www.fckeditor.net
	// by: Pete Forde <pete@unspace.ca> @ Unspace Interactive
	var urlobj;
	var img_upload = false;

	function BrowseServer(obj) {
		urlobj = obj;
		OpenServerBrowser(url_head + '/public/media/filemanager/show', screen.width * 0.7, screen.height * 0.7);
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
	{!! Form::label('image', 'Image:', ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-8 image_upload_field">
		{!! Form::text('image', $carousel['image'], ['class' => 'form-control', 'placeholder' => 'Insert/upload or paste image url', 'autocomplete' => 'off']) !!}
		<span id="image-upload-button"><i class="fa fa-picture-o"></i>Upload</span>
	</div>
</div>
<div class="form-group img_prewiev none">
	{!! Form::label('image-preview', 'Image Preview:', ['class' => 'col-sm-3 control-label']) !!}
	<div id="image-preview" class="col-sm-8"></div>
</div>

<div class="form-group">
	<div class="col-sm-offset-3 col-sm-8">
		{!! Form::submit($button_text, ['class' => 'btn btn-primary form-control']) !!}
	</div>
</div>

<script type="text/javascript">
	$('#image-upload-button').click(function() {
		BrowseServer('image');
	});

	$('#image').on('change keyup paste', function() {
		var value = $(this).val();
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

	$(document).ready(function() {
		if ($('#image').val().length != 0) {
			show_prewiev($('#image').val());
		}
	});
</script>