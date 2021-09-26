function addVideoInput() {
  let count = $(".al-video-input").length

  const video_input = this.video_input(count + 1)

  $("#al-yt-input").append(video_input)
}

function video_input(id) {
  return `
  <div class="row mt-2" id="video_${id}">
    <div class="col-10">
      <input class="al-video-input form-control" type="text" name="video[${id}]" placeholder="Masukkan Link Video Youtube">
    </div>
    <div class="col-2 d-flex align-items-center">
      <button onclick="deleteVideoInput(${id})" type="button" class="btn btn-danger">x</button>
    </div>
  </div>
  `
}

function deleteVideoInput(id) {
  $(`#video_${id}`).remove()
}