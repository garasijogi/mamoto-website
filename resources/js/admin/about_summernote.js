$(function () {
	/* Summernote Intitialization and Validation */
	var summernoteForm = $('#aboutForm');
	var summernoteElement = $('#post');
	
	summernoteElement.summernote({
		height: 300,
		focus: true,
		height: 500,
		placeholder: 'Hi, Please type the post, you can add photos or videos too.',
		tabDisable: true,
		tabsize: 2,
		toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['undo', 'redo', 'fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph', 'style']],
			['height', ['height']],
			['insert', ['picture', 'video', 'link', 'hr']],
			// PRODUCTION remove codeview
			['view', ['fullscreen', 'codeview', 'help']],
			['mybutton', ['hello']]
		],
		buttons: {
			hello: HelloButton
		},
		callbacks: {
			onChange: function (contents, $editable) {
				// Note that at this point, the value of the `textarea` is not the same as the one
				// you entered into the summernote editor, so you have to set it yourself to make
				// the validation consistent and in sync with the value.
				summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);
				if(summernoteElement.summernote('isEmpty')){
					summernoteElement.parent().addClass('bg-danger');
					// tampilkan toast
					Toast.fire({
						icon: 'error',
						title: 'Harap isi about post.'
					})
				} else {
					summernoteElement.parent().removeClass('bg-danger');
				}
			}
		}
	});

	var HelloButton = function (context) {
		var ui = $.summernote.ui;
	
		// create button
		var button = ui.button({
			contents: '<i class="fa fa-child"/> Hello',
			tooltip: 'hello',
			click: function () {
				// invoke insertText method with 'hello' on editor module.
				context.invoke('editor.insertText', 'hello');
			}
		});
	
		return button.render();   // return button as jquery object
	}

	$('#submitAbout').on('click', function(){
		// post validator, if empty
		if(summernoteElement.summernote('isEmpty')){
			summernoteElement.parent().addClass('bg-danger');
			// tampilkan toast
			Toast.fire({
				icon: 'error',
				title: 'Harap isi about post.'
			})
		} else {
			summernoteElement.parent().removeClass('bg-danger');

			// lakukan ajax save data
			Swal.fire({
				icon: 'success',
				title: 'Completed',
				text: 'Validation success'
			});
		}
	});
});