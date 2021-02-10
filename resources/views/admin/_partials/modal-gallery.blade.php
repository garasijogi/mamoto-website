{{-- enable button to try --}}
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalGallery">
  Upload
</button> --}}

<!-- Modal -->
<div class="modal fade" id="modalGallery" tabindex="-1" aria-labelledby="modalGalleryLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      {{-- image viewer inside modal --}}
      @include('admin._partials.modal-imageViewer')
      {{-- modal header --}}
      <div class="modal-header">
        <h5 class="modal-title" id="modalGalleryLabel">Galleri Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{-- modal body --}}
      <div class="modal-body">
        <div id="fileuploader">Upload</div>
        <div class="container">
          <div class="row gallery-content">
            @for ($i = 0; $i < 20; $i++)
              <div class="col-lg-2 col-md-6 col-sm-6 col-6 p-2">
                <div class="d-flex justify-content-center">
                  <div class="card p-2">
                    <div style="overflow: hidden">
                      <div class="rr-gallery-container-image">
                        <div class="rr-gallery-box rr-gallery-stack-image">
                          <img class="rr-gallery-image" src="https://picsum.photos/id/{{ rand(0,999) }}/1080/860" alt="images" />
                          {{-- <img class="rr-gallery-image" src="'+value.src+'" alt="'+value.title+'" /> --}}
                        </div>
                        <div class="rr-gallery-box rr-gallery-stack-top">
                          <div class="rr-gallery-box-button-container">
                            <div class="btn-group">
                              <button class="btn btn-info btn-image-view"><i class="fa fa-search"></i></button>
                              <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endfor
          </div>
          <div class="row gallery-spinner justify-content-center my-3 bg-gray-light">
            <div class="text-center">
              <div class="spinner-grow text-primary" role="status" style="width: 5rem; height: 5rem;">
                <span class="sr-only">Loading...</span>
              </div>
              <div>
                <p class="m-0">Memuat Gambar...</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

{{-- add this section to your view --}}
{{-- @section('css')
<link rel="stylesheet" href="{{ asset('js/admin/jquery-file-upload/jquery-file-upload.css') }}">		
@endsection
@section('js')
<script src="{{ asset('js/admin/jquery-file-upload/jquery-file-upload.min.js') }}"></script>
@endsection --}}