/* -------------------------------------------------------------------------- */
/*                        fungsi setelah action upload                        */
/* -------------------------------------------------------------------------- */
function afterUpload(obj) {
	Toast.fire({
		icon: "success",
		title: "The File was successfully uploaded"
	});
	
	// trigger load gambar pada page pertama
	getPhotos();
}
function afterError(files_jqxhr, status, errMsg, pd) {
	Toast.fire({
		icon: "error",
		title: "Oops, Something went wrong!"
	});
}
