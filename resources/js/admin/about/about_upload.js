/* -------------------------------------------------------------------------- */
/*                        fungsi setelah action upload                        */
/* -------------------------------------------------------------------------- */
function afterUpload(obj) {
	modal_galleryContent.empty(); // hapus semua elemen foto
	// trigger load gambar pada page pertama
	getPhotos(url_gallery);
	Toast.fire({
		icon: "success",
		title: "The File was successfully uploaded"
	});
	
}
function afterError(files_jqxhr, status, errMsg, pd) {
	Toast.fire({
		icon: "error",
		title: "Oops, Something went wrong!"
	});
}
