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
  var files = input.files
  // image list
  for (let i = 0; i < files.length; i++) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#al-imageList').append("<div class='card d-inline-block mx-2'><div class='card-body'><img src='" + e.target.result + "' width='100px' height='100px' style='object-fit:cover;'/></div></div>")
    };
    reader.readAsDataURL(files[i]);
  }

  //file name list
  $("#al-photoBox").remove();
  $("#al-showPhotoNameDiv").attr('class', 'd-block');
  $("#al-showPhotoName").attr('class', 'd-block list-group mb-4');
  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    $("#al-showPhotoName").append("<li class='d-flex justify-content-between list-group-item' >" + file.name + "<a href='#'><i class='text-danger fas fa-window-close'/></a></li>");
  }
}

// imageview
function imageView(id) {
  $('#al-imageViewer').css('display', 'flex');
  let src = $('img.' + id).attr('src');
  $('#al-imageViewed').attr('src', src);
  $('body').css('overflow', 'hidden');
}
$('i.al-close-btn').click(function () {
  $('#al-imageViewer').css('display', 'none')
  $('body').css('overflow', 'auto');
})