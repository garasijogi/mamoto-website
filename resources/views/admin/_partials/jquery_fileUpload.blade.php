{{-- enable button to try --}}
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#jqueryFileUpload">
  Upload
</button> --}}

<!-- Modal -->
<div class="modal fade" id="jqueryFileUpload" tabindex="-1" aria-labelledby="jqueryFileUploadLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="jqueryFileUploadLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="fileuploader">Upload</div>
        <div class="container-fluid">
          <div class="row">
            @for ($i = 0; $i < 10; $i++)
              <div class="col-md-6">
                sakjdskjadsad
              </div>
            @endfor
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