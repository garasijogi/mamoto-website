// Initialisasi Variable
var url_gallery = url_getIndex +
	"?page=" + modal_galleryPaginate +
	"&path=" + path +
	"&index=" + index +
	"&url_getIndex=" + url_getIndex +
	"&url_getNextPage=1" +
	"&url_path=" + url_path +
	"&path=" + path;
var url_gallery_next = "";

// buttons function
btn_showGallery.on("click", function () {
	modal_gallery.modal("show"); // show the gallery modal
	getPhotos(url_gallery); // get photos index
});

// hidden modal gallery listener
modal_gallery.on('hidden.bs.modal', function (event) {
	modal_galleryContent.empty(); // hapus semua elemen foto
	$('.gallery-spinner').show(); // tampilkan spinner, sekaligus mengaktifkan trigger load photos
})

// gallery body listener
modal_galleryBody.on("scroll", function () {
	var scrollHeight = Math.floor(modal_galleryContainer.height());
	var scrollPosition = Math.floor(modal_galleryBody.height() + modal_galleryBody.scrollTop());
	if (scrollPosition >= scrollHeight) {
		getPhotos(url_gallery_next);
	}
});

/* -------------------------------------------------------------------------- */
/*                                fungsi utama                                */
/* -------------------------------------------------------------------------- */
function getPhotos(url) {
	if (!(url == null || url == "" || url == undefined)) {
		$.ajax({
			headers: {
				"X-CSRF-TOKEN": token_csrf // token csrf required by laravel
			},
			type: "GET",
			url: url,
			dataType: "JSON",
			success: function (data) {
				// console.log(data);
				url_gallery_next = data.links.next;
				$.each(data.data, function (index, value) {
					id = value.name.split('.')[0];
					gallery_content.append('<div class="col-lg-2 col-md-6 col-sm-6 col-6 p-2"><div class="d-flex justify-content-center"><div class="card p-2"><div style="overflow:hidden"><div class="rr-gallery-container-image"><div class="rr-gallery-box rr-gallery-stack-image"><img class="rr-gallery-image" src="' + value.src + '" alt="' + value.title + '" /></div><div class="rr-gallery-box rr-gallery-stack-top"><div class="rr-gallery-box-button-container"><div class="btn-group"><a href="javascript:showImage(' + "'" + value.src + "'" + ', ' + "'" + value.title + "'" + ')" class="btn btn-info btn-image-view"><i class="fa fa-search"></i></a><a href="javascript:deleteImage(' + "'" + value.name + "'" + ')" class="btn btn-danger btn-image-delete" id="' + id +'"><i class="fa fa-trash"></i></a></div></div></div></div></div></div></div></div>');
				});
				if(url_gallery_next == null || url_gallery_next == "" || url_gallery_next == undefined){
					$('.gallery-spinner').hide(); // dengan hide spinner, maka tinggi scrollHeight akan berubah, jadinya tidak bakal selalu ketemu trigger load photos lagi dah
				}
			}
		});
	}
}

// delete image
function deleteImage(id) {
	Swal.fire({
		title: 'Hapus Foto Ini?',
		html: "<p>Anda akan menghapus foto ini dari website.</p>",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#0072c6',
		confirmButtonText: 'Ya',
		cancelButtonText: 'Tidak'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				headers: {
					"X-CSRF-TOKEN": token_csrf // token csrf required by laravel
				},
				type: "POST",
				data: {
					id: id,
					path: path,
					index: index,
				},
				url: url_removeIndex,
				beforeSend: function(){
					Swal.fire({
						icon: 'info',
						title: 'Menghapus Foto...',
						html: '<p>Harap Tunggu, sistem sedang menghapus foto.<br/><br/><i class="fa fa-spinner fa-spin fa-2x"></i></p>',
						showConfirmButton: false,
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false
					});
				},
				success: function(data){
					if(data == 1){
						Swal.fire("Dihapus!", "Foto telah dihapus.", "success");
						// hapus element
						el = '#' + id.split('.')[0]
						$(el).parents('.col-lg-2').remove();
					} else {
						Swal.fire('Oops...', 'Something went wrong!', 'error');
					}
				},
				error: function(data){
					Swal.fire('Server Error', 'Please contact Website Admin!', 'error');
				}
			});
		}
	});
}