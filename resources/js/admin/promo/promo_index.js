// remove promo action
// btnPromo_add.on('click', function(){
//   Swal.fire({icon: 'success', title: '', text: ''});
// });

// add promo action
btnPromo_remove.on('click', function(){
  Swal.fire({icon: 'success', title: '', text: ''});
});

// image reader
image_input.on('change', function(e){
  var files = e.target.files;
  var done = function(url){
    image_input.val('');
    image_cropper.src = url;
  };
  var reader;
  var file;
  var url;
  if(files && files.length > 0) {
    file = files[0];

    if(URL){
      done(URL.createObjectURL(file));
    } else if(FileReader) {
      reader = new FileReader();
      reader.onload = function(e){
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }

  image_promo_container.hide();
  image_cropper_container.show();
  
  cropper = new Cropper(image_cropper, {
    aspectRatio: 1,
    viewMode: 3,
  });

  if (cropper){
    Swal.fire({icon: 'success', title: '', text: ''});
  }
});

// image_cropper_btn_cancel.on('click', function(){
//   closeCropper();
// });

image_cropper_btn.on('click', function () {
  var initialImagePromoUrl;
  var canvas;

  if(cropper){
    canvas = cropper.getCroppedCanvas();
    initialImagePromoUrl = image_promo.attr('src');
    image_promo.attr('src', canvas.toDataURL());

    // canvas.toBlob(function(blob){
    //   var formData = new FormData();
    //   formData.append('image_promo'. blob, '')
    // })

  }

  closeCropper();

});

image_cropper_btn_zoomIn.on('click', function (e) {
  cropper.zoom(0.1);
});

image_cropper_btn_zoomOut.on('click', function (e) {
  cropper.zoom(-0.1);
});

image_cropper_btn_rotateLeft.on('click', function(e){
  cropper.rotate(-45);
});

image_cropper_btn_rotateRight.on('click', function(e){
  cropper.rotate(45);
})

image_cropper_btn_modeDrag.on('click', function(e){
  cropper.setDragMode('move');
});

image_cropper_btn_modeCrop.on('click', function (e) {
  cropper.setDragMode('crop');
});

/* -------------------------------- functions ------------------------------- */

// close cropper and destroy the component
function closeCropper(){
  image_promo_container.show();
  image_cropper_container.hide();
  cropper.destroy();
}