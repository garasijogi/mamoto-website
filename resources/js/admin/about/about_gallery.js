// buttons function
btn_showGallery.on("click", function() {
  modal_gallery.modal("show"); // show the gallery modal
  getPhotos(); // get photos index
});
btn_showImage.on("click", function(){
	var image_src = $(this)
		.parent()
		.parent()
		.parent()
		.siblings(".rr-gallery-stack-image")
		.children("img")
		.attr("src");
	var image_alt = $(this)
		.parent()
		.parent()
		.parent()
		.siblings(".rr-gallery-stack-image")
		.children("img")
		.attr("alt");
	showImage(image_src, image_alt);
});

/* -------------------------------------------------------------------------- */
/*                                fungsi utama                                */
/* -------------------------------------------------------------------------- */
var url_gallery = url_getIndex +
	"?page=" + modal_galleryPaginate +
	"&path=" + path +
	"&index=" + index +
	"&url_getIndex=" + url_getIndex +
	"&url_getNextPage=1" +
	"&url_path=" + url_path +
	"&path=" + path;
function getPhotos() {
	$.ajax({
		headers: {
			"X-CSRF-TOKEN": token_csrf // token csrf required by laravel
		},
		type: "GET",
		url: url_gallery,
		dataType: "JSON",
		success: function(data) {
			console.log(data);
			url_gallery = data.links.next;
			$.each(data.data, function(index, value) {
        // gallery_content.append('<div class="col-lg-2 col-md-6 col-sm-6 col-6 p-2"><div class="d-flex justify-content-center"><div class="card p-2"><div style="overflow:hidden"><div class="rr-gallery-container-image"><div class="rr-gallery-box"><img class="rr-gallery-image" src="'+value.src+'" alt="'+value.title+'" /></div><div class="rr-gallery-box rr-gallery-stack-top"><div class="rr-gallery-box-button-container"><div class="btn-group"><button class="btn btn-info btn-image-view"><i class="fa fa-search"></i></button><button class="btn btn-danger"><i class="fa fa-trash"></i></button></div></div></div></div></div></div></div></div>');
      });
		}
	});
}