// 1) User

// 2) Admin
// delete user
$(document).on('click', '.al-deleteUser', function () {
  var username = $(this).attr('data-username');
  $('#delete-form').attr("action", "/admin/user/" + username + "/delete");
});

// bootstrap datepicker
$(function () {
  $('#datetimepicker1').datepicker({
    format: "yyyy/mm/dd",
    weekStart: 0,
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    orientation: "auto"
  });
});

function savePhoto(input) {
  $('#al-imageList').empty();
  $("#al-showPhotoName").empty();
  var files = input.files;
  // image list
  for (let i = 0; i < files.length; i++) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#al-imageList').append("<div id='div-" + i + "' class='card al-img-card-selected d-inline-block mx-2' onclick='alImageView(this.id, 0)'><div class='card-body'><img class='" + i + "' src='" + e.target.result + "' width='100px' height='100px' style='object-fit:cover;' /></div><button id='button-" + i + "' onclick='alDelPhoto(this.id, 1)' class='btn al-del-img-card'> <i class='fas fa-times fa-lg text-red'></i> </button></div>")
    };
    reader.readAsDataURL(files[i]);
  }

  //file name list
  $("#al-photoBox").remove();
  $("#al-showPhotoNameDiv").attr('class', 'd-block');
  $("#al-showPhotoName").attr('class', 'd-block list-group mb-4');
  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    $("#al-showPhotoName").append("<li id='li-" + i + "' class='al-delete-img-btn d-flex justify-content-between list-group-item' onclick='alImageView(this.id, 1)' >" + file.name + "<div id='" + i + "' class='al-delete-img-btn' onclick='alDelPhoto(" + i + ", 0)'><i class='text-danger fas fa-window-close'></i></div></li>");
  }
}

function editPhoto(input) {
  $("#al-addPhotoName").empty();
  $("div.al-editImageCard").unwrap();
  $("div.al-editImageCard").remove();
  var files = input.files
  // image list
  for (let i = 0; i < files.length; i++) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#al-imageList').append("<div id='div-" + i + "' class='card d-inline-block mx-2'><div class='card-body al-editImageCard'><img src='" + e.target.result + "' width='100px' height='100px' style='object-fit:cover;'/></div></div>")
    };
    reader.readAsDataURL(files[i]);
  }

  //file name list
  $("#al-photoBox").remove();
  $("#al-showPhotoNameDiv").attr('class', 'd-block');
  $("#al-addPhotoName").attr('class', 'd-block list-group mb-4');
  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    $("#al-addPhotoName").append("<li id='li-" + i + "' class='al-delete-img-btn d-flex justify-content-between list-group-item' >" + file.name + "<div id='" + i + "' class='al-delete-img-btn' onclick='alDelPhoto(" + i + ", 0)'><i class='text-danger fas fa-window-close'></i></div></li>");
  }
}

// imageview
function alImageView(id, target) {
  switch (target) {
    case 'id': id = id;
      break;
    case 'li': id = id.replace('li-', '');
      break;
    case 'div': id = id.replace('div-', '');
      break;
    case 0: id = id.replace('div-', '');
      break;
    case 1: id = id.replace('li-', '');
      break;
    default: id = id;
  }
  $('#al-imageViewer').css('display', 'flex');
  let src = $('img.' + id).attr('src');
  $('#al-imageViewed').attr('src', src);
  $('body').css('overflow', 'hidden');
}
$('i.al-close-btn').click(function () {
  $('#al-imageViewer').css('display', 'none')
  $('body').css('overflow', 'auto');
})

// delete photo name list
function alDelPhoto(id, target) {
  switch (target) {
    case 1: id = id.replace('button-', '');
      break;
    default: id = id;
  }
  event.stopPropagation();
  $('#li-' + id).attr('class', 'd-none');
  $('#div-' + id).attr('class', 'd-none');
  $('#al-deletePhotoContainer').append("<input type='hidden' name='imgDel[]' value='" + id + "' />")
};

// show delete img button on img preview list
$('div').on('mouseenter', '.al-img-card-selected', function (e) {
  $('#button-' + (this.id).replace('div-', '')).css('display', 'unset');
}).on('mouseleave', '.al-img-card-selected', function () {
  $('.al-del-img-card').css('display', 'none');
});

//change foto
// function changePhoto(input, id) {
//   var files = input.files;
// $('#image').cropper('destroy');
// //   // image list
// for (let i = 0; i < files.length; i++) {
//   var reader = new FileReader();
//   reader.onload = function (e) {
//     $("#image").attr("src", e.target.result);
//     $("#jumbo" + id).attr("src", e.target.result);
//   };
//   reader.readAsDataURL(files[i]);
// }
// }

//cropper
var $modal = $('#modal');
var image = $('#image');
var cropper;
var index;

$(".image").on("change", function (e) {
  let split_id = this.id.split("_", 2);
  index = split_id[1];
  var files = e.target.files;
  //   // image list
  for (let i = 0; i < files.length; i++) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#image").attr("src", e.target.result);
      $("#jumbo" + index).attr("src", e.target.result);
    };
    reader.readAsDataURL(files[i]);
  }
  var done = function (url) {
    image.src = $("#jumbo" + index).attr("src", e.target.result);
    $modal.modal('show');
  };

  // $("#image").attr("src", e.target.result);
  // $("#jumbo" + id).attr("src", e.target.result);
  var reader;
  var file;
  var url;

  if (files && files.length > 0) {
    file = files[0];

    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function (e) {
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }
});

$modal.on('shown.bs.modal', function () {
  cropper = image.cropper({
    aspectRatio: 16 / 9,
    viewMode: 3
  });
}).on('hidden.bs.modal', function () {
  $('#image').cropper('destroy');
  cropper = null;
});

$("#crop").on('click', function () {
  canvas = $('#image').cropper('getCroppedCanvas', {
    width: 1024,
    height: 576,
  });

  canvas.toBlob(function (blob) {
    url = URL.createObjectURL(blob);
    var reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function () {
      var base64data = reader.result;
      console.log(base64data)
      $("#image").attr("src", base64data);
      $("#jumbo" + index).attr("src", base64data);
      $("#inputjumbo" + index).attr("value", base64data);
      $modal.modal('hide');
    }
  });
})

$('.selected').on('click', function () {
  $('.selected').css('background-color', 'white').css('color', 'black');
  $(this).css('background-color', 'green').css('color', 'white');
  $('.selected-portfolio').html($(this).data('name'))
  $('#selected_portfolio').attr('value', $(this).data('id'));
  $('#selected_portfolio_form').attr('action', '/admin/displayed-portfolio/' + $(this).data('pftype') + '/edit');
});

$('.submit-form').on('click', function () {
  $('#selected_portfolio_form').submit();
})

function changeJumbotron(where) {
  let now = parseInt($('.al-jumbotron-carousel').data('now'));
  where == 'next' ? now++ : now--;
  now > 4 ? now = 1 : now = now;
  now < 1 ? now = 4 : now = now;
  $('.al-jumbotron-carousel').data('now', '' + now);
  let url = 'url("../../..' + $('.al-jumbotron-carousel').data('jumbotron' + now) + '")';
  $('.al-jumbotron-carousel')
    .fadeOut(500, function () {
      $('.al-jumbotron-carousel').css('background-image', url);
    })
    .fadeIn(500);
}

// displayed feedback on kelola home
function modalCustomerPhotoUpload() {
  $('#feedback-modal').modal('hide');
  $('.modal-backdrop').remove();
}

$("#customer-photo").on("change", function (e) {
  var files = e.target.files;

  for (let i = 0; i < files.length; i++) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#image").attr("src", e.target.result);
      $("#image-cropped").attr("src", e.target.result);
    };
    reader.readAsDataURL(files[i]);
  }

  $('#modal').modal("show");
  $('#modal').on('shown.bs.modal', function () {
    cropper = $("#image-cropped").cropper({
      aspectRatio: 1 / 1,
      viewMode: 3
    });
  }).on('hidden.bs.modal', function () {
    $('#image-cropped').cropper('destroy');
    cropper = null;
  });
});

function crop_image() {
  var canvas = $('#image-cropped').cropper('getCroppedCanvas', {
    width: 512,
    height: 512,
  });

  canvas.toBlob(function (blob) {
    url = URL.createObjectURL(blob);
    var reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function () {
      var base64data = reader.result;
      $("#image").attr("src", base64data);
      $('#inputCustomerFile').attr('value', base64data);
      $("#modal").modal('hide');
    }
  });
}

function submitForm(formName) {
  $('#' + formName).submit();
}

$('.change-feedback').on('click', function () {
  $('#dp_id').attr('value', $(this).data('id'));
})

$('.dp-id').on('click', function () {
  $('#feedback_id').attr('value', $(this).data('id'));
})

$('.reset-feedback').on('click', function () {
  $('#reset-feedback-modal .modal-body h6').text('Apakah Anda yakin ingin mereset feedback ke-' + $(this).data('id') + ' yang ditampilkan?');
  $('#reset-feedback-modal .modal-footer button.btn-primary').attr('data-id', $(this).data('id'));
})

$('#reset-feedback-modal .modal-footer button.btn-primary').on('click', function () {
  window.location.href = '/admin/displayed-feedback/' + $(this).data('id') + '/clear';
})


//feedback on home user
function changeFeedback(where, size) {
  let index = parseInt(($('.feedback-selected').attr("class").split(/\s+/))[1]);
  size = parseInt(size);
  let goTo = index;
  where == 'next' ? goTo++ : goTo--;
  goTo + 1 > size ? goTo = 0 : '';
  goTo < 0 ? goTo = size - 1 : '';
  $('.feedback-selected').attr("class", 'd-none ' + index);
  $('.' + goTo).attr("class", "feedback-selected " + goTo);
}
