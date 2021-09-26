// document on load function
$(function(){
  getPromo();
});

/* ------------------------------ ajax handler ------------------------------ */
let scrollEnabled = true;
const getPromo = (url=url_get) => {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': token_csrf
    },
    url: url,
    method: 'GET',
    beforeSend: function(){
      scrollEnabled = false;
    },
    success: function(data){
      url_next = data.next_page_url // ganti url next
      // jika url_next nya tidak kosong, maka aktifkan scroll event
      if (url_next == null || url_next == undefined || url_next == "") {
        spinner_promo.hide();
      } else {
        scrollEnabled = true;
      }
      // cek apa datanya ada
      if (data.data == [] || data.data == "" || data.data == null || data.data == undefined){
        container_promo_content.hide();
        container_promo_contentNo.show();
        flag_previousRetrieveNull = true; // nyalakan flag
      } else {
        // apabila data ada tapi sebelumnya datanya belum ada
        if(flag_previousRetrieveNull == true){
          container_promo_content.show();
          container_promo_contentNo.hide();
          flag_previousRetrieveNull = false; // matikan flag
        }
        $.each(data.data, function (index, value) {
          container_promo_row.append('<div div class= "col-lg-6 col-12 card-promo" > <div class="card mb-3" style="max-width:100%"><div class="row no-gutters"><div class="col-lg-5 col-md-4"><img class="rr-image-responsive" src="' + value.photo + '" alt="Poster Promo ->' + value.name + '"></div><div class="col-lg-7 col-md-8"><div class="card-body h-100 card-body-promo-card"><h5 class="card-title font-weight-bolder">' + value.name + '</h5><p class="card-text mb-0 font-weight-lighter">' + value.post + '</p><p class="card-text"><small class="text-muted">Ditambahkan ' + value.created_at + '</small></p><div class="d-flex justify-content-end btn-promo-container"><div class="btn-group" data-id="' + value.id + '"><button class="btn btn-danger btn-promo-remove"><i class="fas fa-trash-alt"></i></button><button class="btn btn-primary btn-promo-edit"><i class="fa fa-eye"></i></button></div></div></div></div></div></div></div>');
        });
      }
      
    },
    error: function(e){
      Swal.fire({icon: 'error', title: 'Oops...', text: 'Something went wrong!'});
    }
  })
};
// scroll modal listener
$(window).on("scroll", function () {
  if (url_next == null || url_next == undefined || url_next == "") {
    // nothing
  } else {
    if (scrollEnabled) {
      var scrollHeight = Math.floor($('html').height());
      var scrollPosition = Math.floor($(window).height() + $(window).scrollTop());
      if (scrollPosition >= scrollHeight) {
        getPromo(url_next);
      }
    }
  }
});

/* ----------------------------- button handler ----------------------------- */
btnPromo_addPromo.on('click', function () {
  toggle_form = 'add';
  btnPromo_submit.html(btnContent_add); // ganti tulisan button
  modal_promo.modal('show');
});
// remove all button
btnPromo_removeAll.on('click', function () {
  Swal.fire({
    icon: 'warning',
    title: 'Apa anda yakin?',
    html: '<div class="bg-gray text-white py-2"><b>saya yakin untuk menghapus promo</b></div>',
    input: 'text',
    inputLabel: 'Ketikkan kalimat di atas, untuk menghapus semua promo',
    showCancelButton: true,
    allowOutsideClick: false,
    inputValidator: (value) => {
      if (value != 'saya yakin untuk menghapus promo') {
        return 'Kalimat yang anda ketikkan salah'
      } else {
        // window.location.replace(url_removeAll);
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': token_csrf
          },
          url: url_removeAll,
          method: 'POST',
          success: function (data) {
            Toast.fire({ icon: 'success', title: 'Semua Promo berhasil dihapus' });

            // refresh data promo
            container_promo_row.empty();
            spinner_promo.show();
            getPromo(url_get);
          },
          error: function (e) {
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong!' });
          }
        });
      }
    }
  })
});
// trigger cliknya dari container tapi liat ke dalemnya apa arahnya ke edit atau remove
container_promo_row.on('click', btnPromo_edit, function () {
  // ganti id form jadi form edit
  toggle_form = 'edit';
  btnPromo_submit.html(btnContent_edit); // ganti tulisan button
  resetForm();
  edit_promo_id = $(this).parent().data('id');
  overlay_promo_modal.show();
  modal_promo.modal('show');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': token_csrf
    },
    url: url_getOnce,
    data: {
      'id': edit_promo_id
    },
    method: 'POST',
    complete: function(){
      overlay_promo_modal.fadeOut();
    },
    success: function(data){
      // siapkan data response ke view
      input_name.val(data.name);
      textarea_post.text(data.post);
      textarea_link.text(data.link);
      input_image.val(data.photo);
      edit_promo_originPhoto = data.photo;
      image_promo.attr('src', data.photo_link); // reset image chooser ke default
      // ganti kelas stack jadi hover
      (image_promo_stack.hasClass('rr-promo-add-image-stack-static')) ? image_promo_stack.removeClass('rr-promo-add-image-stack-static').addClass('rr-promo-add-image-stack-hover') : "";
    },
    error: function(e){
      Swal.fire({icon: 'error', title: 'Oops...', text: 'Something went wrong!'});
    }
  })
});
container_promo_row.on('click', btnPromo_remove, function () {
  let id_promoToRemove = $(this).parent().data('id');
  Swal.fire({
    title: 'Hapus Promo ini?',
    text: "Promo yang sudah dihapus tidak dapat dikembalikan kembali.",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya',
    cancelButtonText: 'Tidak',
    focusCancel: true,
    allowOutsideClick: false,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': token_csrf
        },
        url: url_remove,
        data: {
          'id': id_promoToRemove
        },
        method: 'POST',
        beforeSend: function(){
          showLoadingSwal('Menghapus Promo', 'Harap tunggu sistem sedang menghapus promo ini.');
        },
        success: function (data) {
          // hapus element dari DOM
          $('[data-id="'+id_promoToRemove+'"]').parents('.card-promo').remove();
          // jika element dom habis maka nyalakan no element dengan
          if (container_promo_row.is(':empty')) {
            container_promo_content.hide();
            container_promo_contentNo.show();
            flag_previousRetrieveNull = true; // nyalakan flag
          }
          Toast.fire({ icon: 'success', title: 'Promo telah dihapus' });
        },
        error: function (e) {
          Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong!' });
        }
      })
    }
  })
});

/* --------------------------------- cropper -------------------------------- */
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
    aspectRatio: 16 / 9,
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
    // hapus class lama biar bisa hover
    (image_promo_stack.hasClass('rr-promo-add-image-stack-static')) ? image_promo_stack.removeClass('rr-promo-add-image-stack-static').addClass('rr-promo-add-image-stack-hover') : "";
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

/* ---------------------------- daterange picker ---------------------------- */
input_daterange.daterangepicker({
  "autoUpdateInput": false,
  "minDate": moment(),
  "locale": {
    "format": "DD MMMM YYYY",
    "applyLabel": "Pilih",
    "cancelLabel": "Hapus",
    "separator": " - ",
    "daysOfWeek": [
      "Min",
      "Sen",
      "Sel",
      "Rab",
      "Kam",
      "Jum",
      "Sab"
    ],
    "monthNames": [
      "Januari",
      "Februari",
      "Maret",
      "April",
      "Mei",
      "Juni",
      "Juli",
      "Agustus",
      "September",
      "Oktober",
      "November",
      "Desember"
    ],
    "firstDay": 1
  },
  "opens": "center",
  "drops": "auto"
}, function (start, end, label) {
});
// on apply daterangepicker
input_daterange.on('apply.daterangepicker', function (ev, picker) {
  $(this).val(picker.startDate.format('DD MMMM YYYY') + ' - ' + picker.endDate.format('DD MMMM YYYY')); // set value tanggal dan format locally

  // ubah value pada input hidden period
  let dateRaw = $(this).val();
  let dateArray = dateRaw.split(" - ");
  $.each(dateArray, function (i, v) {
    dateArray[i] = moment(v, "DD MMMM YYYY", 'id').format('YYYY-MM-DD');
  });
  let dateChoosen = dateArray[0] + "/" + dateArray[1];
  input_period.val(dateChoosen);
});
// on cancel, clear the form control
input_daterange.on('cancel.daterangepicker', function (ev, picker) {
  $(this).val(''); // hapus form
  input_period.val('');
});

/* ------------------------------ form handler ------------------------------ */
// form validation and submit handler
formPromo.validate({
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

    if (photo == "" || photo == undefined || photo == null) {
      Swal.fire({ icon: 'error', title: 'Poster tidak boleh kosong.', text: 'Harap tambahkan poster promo.' });
    } else {
      // prepare form data
      let period = input_period.val();
      let period_splitted = period.split('/');
      let formData = {
        name: form.name.value,
        post: form.post.value,
        period_start: period_splitted[0],
        period_end: period_splitted[1],
        link: form.link.value,
        photo: photo
      };

      // action add promo
      if (toggle_form == 'add') {
        // lakukan ajax add request
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': token_csrf
          },
          url: url_formAdd,
          method: 'POST',
          data: formData,
          beforeSend: function () {
            // menampilkan swal loading
            showLoadingSwal('Menambahkan Promo..', 'Harap Tunggu, sistem sedang menambahkan promo.');
          },
          success: function (data) {
            Toast.fire({ icon: 'success', title: 'Promo telah ditambahkan' });
            // reset the form and image chooser
            resetForm();
            modal_promo.modal('hide'); // sembunyikan modal form add

            // refresh data promo
            container_promo_row.empty();
            spinner_promo.show();
            getPromo(url_get);
          },
          error: function (e) {
            showErrorSwal_validation(e.responseJSON);
          }
        })
      } else if (toggle_form == 'edit') { // action edit promo
        formData.id = edit_promo_id;
        formData.photo_origin = edit_promo_originPhoto;
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': token_csrf
          },
          url: url_formEdit,
          method: 'POST',
          data: formData,
          beforeSend: function(){
            // reset the form and image chooser
            resetForm();
            modal_promo.modal('hide'); // sembunyikan modal form add
            // menampilkan swal loading
            showLoadingSwal('Menyimpan Promo..', 'Harap Tunggu, sistem sedang menyimpan perubahanmu.');
          },
          success: function(data){
            Toast.fire({ icon: 'success', title: 'Promo telah disimpan' });
            // edit DOM element
            let el = container_promo_row.find('div[data-id="' + data.id + '"]');
            el.parent().siblings('h5.card-title').text(data.name);
            el.parent().siblings('p.card-text.mb-0.font-weight-lighter').text(data.post);
            el.parents('div.col-lg-7.col-md-8').siblings('div.col-lg-5.col-md-4').find('img').attr('src', data.photo);
          },
          error: function(e){
            showErrorSwal_validation(e.responseJSON);
          }
        });
      // action error
      } else {
        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong!' });
      }
    }
  }
});

/* ------------------------------ modal handler ----------------------------- */
modal_promo.on('hidden.bs.modal', function(){
  (toggle_form == "edit") ? resetForm() : null;
});

/* ----------------------------- other function ----------------------------- */
// function to reset form
const resetForm = () => {
  formPromo[0].reset();
  textarea_post.text('');
  textarea_link.text('');
  image_promo.attr('src', image_default); // reset image chooser ke default
  (image_promo_stack.hasClass('rr-promo-add-image-stack-hover')) ? image_promo_stack.removeClass('rr-promo-add-image-stack-hover').addClass('rr-promo-add-image-stack-static') : "";
  input_image.val(''); // kosongkan input hidden image
  input_period.val('');
}

// show swalerror on ajax error, validation error
const showErrorSwal_validation = (response) => {
  // buat pesan error
  let msg_error = "";
  $.each(response, function (index, value) {
    $.each(value, function (i, v) {
      msg_error += '<li style="list-style-type: none;">' + v + '</li>';
    });
  });

  // tampilkan pesan error di swal
  Swal.fire({ icon: 'error', title: 'Error', html: msg_error });
}

// showing loading swal while ajax request running
const showLoadingSwal = (title, text) => {
  Swal.fire({
    icon: 'info',
    title: title,
    html: '<p>'+text+'<br/><br/><img src="' + image_spinner_src + '" alt="loading icon" style="width: 5em;"></p>',
    showConfirmButton: false,
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false
  });
}