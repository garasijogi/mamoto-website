// remove promo action
btnPromo_remove.on('click', function(){
  Swal.fire({icon: 'success', title: '', text: ''});
});

// image reader on input files
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

  // hide image input container and show image cropper container
  image_promo_container.hide();
  image_cropper_container.show();
  // initialize image cropper
  cropper = new Cropper(image_cropper, {
    aspectRatio: 1,
    viewMode: 3,
  });
});

// crop button action
image_cropper_btn.on('click', function () {
  var initialImagePromoUrl;
  var canvas;

  if(cropper){
    canvas = cropper.getCroppedCanvas();
    initialImagePromoUrl = image_promo.attr('src');
    let image_cropped = canvas.toDataURL(); // ambil image yg udh di cropped, data dalam bentuk base64
    image_promo.attr('src', image_cropped); // tambahkan ke image input
    input_image.val(image_cropped); // tambahkan ke form image
    image_cropper.src = image_spinner_src; // ganti image cropper jadi image spinner
    image_promo_container.show();
    image_cropper_container.hide();
    cropper.destroy();
  }
});
// crop button tools
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

// form add validation and submit handler
$('#formAddPromo').validate({
  rules: {
    name: {
      required: true,
      minlength: 8
    },
    post: {
      required: true,
      minlength: 12
    },
    link: {
      required: true
    },
  },
  messages: {
    name: {
      required: "Harap masukkan Judul Promo",
      minlength: 'Setidaknya harus 5 karakter untuk Judul Promo.'
    },
    post: {
      required: "Harap masukkan Keterangan Promo",
      minlength: "Setidaknya harus 12 karakter untuk Keterangan Promo."
    },
    link: "Harap masukkan pesan teks, untuk pesan otomatis saat tombol order diklik."
  },
  errorElement: 'span',
  errorPlacement: function (error, element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
  },
  // submit handler untuk mengirim form lewat ajax
  submitHandler: function(form){
    let photo = input_image.val();

    if(photo == "" || photo == undefined || photo == null) {
      Swal.fire({ icon: 'error', title: 'Poster tidak boleh kosong.', text: 'Harap upload poster promo.' });
    } else {
      // prepare form data
      let formData = {
        name: form.name.value,
        post: form.post.value,
        link: form.link.value,
        photo: photo
      };
      // lakukan ajax request
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': token_csrf
        },
        url: url_formAdd,
        method: 'POST',
        data: formData,
        beforeSend: function(){
          // reset the form and image chooser
          formAddPromo[0].reset();
          image_promo.attr('src', image_default); // reset image chooser ke default
          modal_addPromo.modal('hide'); // sembunyikan modal form add
          input_image.val(''); // kosongkan input hidden image
          // menampilkan swal loading
          Swal.fire({
            icon: 'info',
            title: 'Menambahkan Promo..',
            html: '<p>Harap Tunggu, sistem sedang menambahkan promo.<br/><br/><img src="'+image_spinner_src+'" alt="loading icon" style="width: 5em;"></p>',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
          });
        },
        success: function(data){
          Swal.fire({icon: 'success', title: 'Promo telah ditambahkan'});

          // refresh data promo
        },
        error: function(e){
          response = e.responseJSON;
          // buat pesan error
          let msg_error = "";
          $.each(response, function(index, value){
            $.each(value, function(i,v){
              msg_error += '<li style="list-style-type: none;">' + v + '</li>';
            });
          });

          // tampilkan pesan error di swal
          Swal.fire({icon: 'error', title: 'Error', html: msg_error});
        }
      })
    }
  }
});