summernoteElement.summernote({
	height: 300,
	focus: true,
	height: 500,
	placeholder: 'Hi, Please type the post, you can add photos or videos too.',
	tabDisable: true,
	tabsize: 4,
	lang: 'id-ID',
	toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['font', ['strikethrough', 'superscript', 'subscript']],
		['fontsize', ['undo', 'redo', 'fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph', 'style']],
		['height', ['height']],
		['insert', ['gallery', 'video', 'link', 'hr']],
		// PRODUCTION remove codeview
		['view', ['fullscreen', 'codeview', 'help']],
	],
	callbacks: {
		onChange: function (contents, $editable) {
			// Note that at this point, the value of the `textarea` is not the same as the one
			// you entered into the summernote editor, so you have to set it yourself to make
			// the validation consistent and in sync with the value.
			summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);
			// ganti icon jadi spinner
			icon_save.empty().append('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');
			if(summernoteElement.summernote('isEmpty')){
				summernoteElement.parent().addClass('bg-danger');
				// tampilkan toast
				toastValidateError();
			} else {
				summernoteElement.parent().removeClass('bg-danger');
			}
			
			// ubah style tombol save
			summernoteSaveButton.removeClass('btn-secondary').addClass('btn-danger');
		},
	},
	gallery: { // summernote gallery settings
		source: {
			// data: [],
			url: url_getIndex + 
				"?page=1" + 
				"&path=" + path +
				"&index=" + index +
				"&url_getIndex=" + url_getIndex +
				"&url_getNextPage=1" +
				"&url_path=" + url_path +
				"&path=" + path,
			// responseDataKey: 'data',
			nextPageKey: 'links.next',
		},
		modal: {
			loadOnScroll: true,
			// maxHeight: 300,
			title: "Tambahkan Gambar",
			close_text: 'Batalkan',
			ok_text: 'Tambahkan',
			selectAll_text: 'Pilih Semua',
			deselectAll_text: 'Pilih Tidak Semua',
			noImageSelected_msg: 'Tidak ada gambar yang dipilih, harap pilih satu',
		}
	}
});

summernoteSaveButton.on('click', function(){
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
					allowOutsideClick: false,
					allowEscapeKey: false,
					allowEnterKey: false
				});
			},
			success: function(data){
				icon_save.empty().append('<i class="fa fa-save"></i>');
				// console.log(data);
				summernoteSaveButton.removeClass('btn-danger').addClass('btn-secondary');
				Toast.fire({
					icon: 'success',
					title: 'Perubahanmu sudah disimpan'
				})
			}
		})
	}
});

// toast validate error for about
function toastValidateError(){
	Toast.fire({
		icon: 'error',
		title: 'Harap isi about post'
	});
}