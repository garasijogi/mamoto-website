$(function () {
	/* Summernote Intitialization and Validation */
	var summernoteForm = $('#aboutForm');
	var summernoteElement = $('#post');
	var about_url = $('input[name="about_url"]').val();
	var token_csrf = $('input[name="token_csrf"]').val();
	
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
			['myButton', ['myVideo']]
		],
		buttons: {
      myVideo: function(context) {
        var ui = $.summernote.ui;
        var button = ui.button({
          contents: '<i class="fa fa-video-camera"/>',
          tooltip: 'video',
          click: function() {
            var div = document.createElement('div');
            div.classList.add('embed-container');
            var iframe = document.createElement('iframe');
            iframe.src = prompt('Enter video url:');
            iframe.setAttribute('frameborder', 0);
            iframe.setAttribute('width', '100%');
            iframe.setAttribute('allowfullscreen', true);
            div.appendChild(iframe);
            context.invoke('editor.insertNode', div);
          }
        });

        return button.render();
      }
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
					toastValidateError();
				} else {
					summernoteElement.parent().removeClass('bg-danger');
				}
			}
		}
	});

	$('#submitAbout').on('click', function(){
		// post validator, if empty
		if(summernoteElement.summernote('isEmpty')){
			summernoteElement.parent().addClass('bg-danger');
			// tampilkan toast
			toastValidateError();
		} else {
			summernoteElement.parent().removeClass('bg-danger');

			// lakukan ajax save data
			Swal.fire({
				icon: 'success',
				title: 'Completed',
				text: summernoteElement.summernote('code')
			});

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': token_csrf
				},
				url: about_url,
				data: {
					post: summernoteElement.summernote('code')
				},
				method: "POST",
				beforeSend: function() {
					Swal.fire({
            icon: 'info',
            title: 'Menyimpan Perubahan...',
            html: '<p>Harap Tunggu, sistem sedang menyimpan perubahanmu.<br/><br/><i class="fa fa-spinner fa-spin fa-2x"></i></p>',
            showConfirmButton: false,
            // allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        	});
				},
				success: function(data){
					console.log(data);
					Toast.fire({
						icon: 'success',
						title: 'Perubahanmu sudah disimpan'
					})
				}
			})
		}
	});
});

function toastValidateError(){
	Toast.fire({
		icon: 'error',
		title: 'Harap isi about post'
	});
}