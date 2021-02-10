// Get the image and insert it inside the modal - use its "alt" text as a caption
var imageViewer_modal = $('.imageViewer-modal');
var img = document.getElementById("myImg");
var modalImg = $("#imageViewer-img");
var captionText = document.getElementById("imageViewer-caption");

// Get the <span> element that closes the modal
var imageViewer_closeBtn = document.getElementsByClassName("imageViewer-close")[0];

// When the user clicks on <span> (x), close the modal
imageViewer_closeBtn.onclick = function() {
  // Get the modal
  imageViewer_modal.css('display', 'none');
};

/* ---------------------- tampilkan modal image viewer ---------------------- */
function showImage(image_src, image_alt) {
  modalImg.attr('src', image_src);
  captionText.innerHTML = image_alt;
  imageViewer_modal.css('display', 'block');
}