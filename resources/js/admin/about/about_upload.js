/* -------------------------------------------------------------------------- */
/*                        fungsi setelah action upload                        */
/* -------------------------------------------------------------------------- */
function afterUpload(obj){
  Toast.fire({
    icon: 'success',
    title: 'The File was successfully uploaded'
  });

  // trigger load gambar pada page pertama
  getFiles(1);
}
function afterError(files_jqxhr,status,errMsg,pd){
  Toast.fire({
    icon: 'error',
    title: 'Oops, Something went wrong!'
  });
}

/* -------------------------------------------------------------------------- */
/*                                fungsi utama                                */
/* -------------------------------------------------------------------------- */
function getFiles(paginate) {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': token_csrf // token csrf required by laravel
    },
    data: {
      path: path,
      index: index,
      paginate: paginate,
      url_getIndex: url_getIndex,
      url_getNextPage: url_getNextPage,   
      url_path: url_path,
    },
    type: "GET",
    url: url_getIndex,
    dataType: "JSON",
    success: function(data) {
      console.log(data);
    }
  });
}