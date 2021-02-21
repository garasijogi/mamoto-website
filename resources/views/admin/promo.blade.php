@extends('adminlte::page')

@section('title', 'Kelola Promo')

@section('content_header')
<div class="d-flex justify-content-between">
  <div>
    <h1>Kelola Promo</h1>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-danger btn-promo-removeAll"><i class="fa fa-trash-alt"></i> Hapus Semua Promo</button>
    <button type="button" class="btn btn-success btn-promo-add"><i class="fa fa-plus-circle"></i> Tambah Promo</button>
  </div>
</div>
@endsection

@section('content')

{{-- main content --}}
<div class="card">
  <div class="card-body">
    {{-- promo cards --}}
    <div>
      {{-- content --}}
      <div class="row promo-content">
        {{-- example code of card content --}}
        {{-- <div class="col-lg-6 col-12 card-promo">
          <div class="card mb-3" style="max-width:100%">
            <div class="row no-gutters">
              <div class="col-lg-5 col-md-4"><img class="rr-image-responsive" src="' + value.photo + '" alt="Poster Promo ->' + value.name + '">
              </div>
              <div class="col-lg-7 col-md-8">
                <div class="card-body h-100 card-body-promo-card">
                  <h5 class="card-title">' + value.name + '</h5>
                  <p class="card-text mb-0">' +value.post+'</p>
                  <p class="card-text"><small class="text-muted">Ditambahkan ' + value.created_at + '</small></p>
                  <div class="d-flex justify-content-end btn-promo-container">
                    <div class="btn-group" data-id="' + value.id +'">
                      <button class="btn btn-danger btn-promo-remove"><i class="fas fa-trash-alt"></i></button>
                      <button class="btn btn-primary btn-promo-edit"><i class="fa fa-eye"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
      {{-- loading spinner --}}
      <div class="my-2 promo-spinner">
        <div class="row justify-content-center">
          <div class="col-auto">
            <div class="spinner-grow text-primary" role="status">
              <span class="sr-only">Memuat...</span>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-auto">
            <p class="m-0">Memuat...</p>
          </div>
        </div>
      </div>
    </div>

    {{-- tampilan tidak ada promo --}}
    <div style="display: none">
      <div class="d-flex justify-content-center mb-3">
        <div class="rr-promo-noPromo-image-container"
          style="background-image: url({{ asset('images/default/discount.svg') }}); background-repeat: round;">
          {{-- <img class="rr-image-responsive" src="{{ asset('images/default/discount.svg') }}"alt="tidak ada promo yang
          ditambahkan"> --}}
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <p><b>Tidak ada Promo</b> yang ditambahkan.</p>
      </div>
    </div>
  </div>
</div>

<!-- modal promo -->
<div class="modal fade" id="modal_promo" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="modal_promoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="overlay dark overlay-promo-modal" style="display: none">
        <div class="row no-gutters h-100 w-100 justify-content-center">
          <div class="col-lg-1 col-2 align-self-lg-center mt-5" >
            <img class="w-100" src="{{ asset('images/default/spinner.svg') }}" alt="spinner">
          </div>
        </div>
      </div>
      <div class="modal-header">
        <h5 class="modal-title" id="modal_promoLabel">Form Promo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6 order-lg-1 order-2">
            <form id="formPromo" action="#" method="post" novalidate>
              <div class="form-group">
                <label for="promo-name">Judul</label>
                <input name="name" type="text" class="form-control" id="promo-name" placeholder="Judul Promo">
              </div>
              <div class="form-group">
                <label for="promo-post">Keterangan</label>
                <textarea name="post" class="form-control" id="promo-post" rows="5" placeholder="Keterangan Promo"></textarea>
              </div>
              <div class="form-group">
                <label for="promo-link">Teks Whatsapp</label>
                <textarea name="link" class="form-control" id="promo-link" rows="3" placeholder="Teks Pesan di Whatsapp"
                  data-toggle="tippy" data-title="Masukkan text pesan untuk pemesanan melalui whatsapp"></textarea>
              </div>
              {{-- image form --}}
              <input type="hidden" name="photo">
            </form>
          </div>
          <div class="col-lg-6 order-lg-2 order-1">
            <div class="row">
              <div class="col">
                <label class="d-block text-center">Poster atau Gambar</label>
              </div>
            </div>
            <div class="row justify-content-center image-promo-container">
              <div class="col-lg-7 col-sm-8 col card mb-0 p-3 m-sm-0 m-4">
                <label class="label mb-0 rr-promo-add-label">
                  <img class="rounded rr-image-responsive rr-promo-add-image" src="{{ asset('images/default/image.svg') }}" alt="image poster">
                  <input type="file" class="sr-only" id="inputImage" name="image" accept="image/*">
                  <div class="rr-promo-add-image-stack rr-promo-add-image-stack-static rounded-lg d-flex justify-content-center">
                    <p class="label mb-0 align-self-center text-white">Pilih poster promo</p>
                  </div>
                </label>
              </div>
            </div>
            <div class="image-cropper-container" style="display: none">
              <div class="row justify-content-center">
                <div class="col-auto card mb-0 p-3 m-sm-0 m-4">
                  <div>
                    <img id="cropper" class="rounded rr-promo-image-cropper" src="{{ asset('images/default/spinner.svg') }}">
                  </div>
                </div>
              </div>
              <div class="row justify-content-center mt-2">
                <div class="col-auto">
                  <div class="d-flex justify-content-center">
                    <div class="btn-group mr-2">
                      <button id="cropperModeDrag" class="btn btn-primary btn-sm" data-toggle="tippy" data-title="Geser Gambar"><i class="fa fa-arrows-alt"></i></button>
                      <button id="cropperModeCrop" class="btn btn-primary btn-sm" data-toggle="tippy" data-title="Potong Gambar"><i class="fa fa-crop-alt"></i></button>
                    </div>
                    <div class="btn-group mr-2">
                      <button id="cropperZoomIn" class="btn btn-primary btn-sm" data-toggle="tippy" data-title="Perbesar"><i class="fa fa-search-plus"></i></button>
                      <button id="cropperZoomOut" class="btn btn-primary btn-sm" data-toggle="tippy" data-title="Perkecil"><i class="fa fa-search-minus"></i></button>
                    </div>
                    <div class="btn-group">
                      <button id="cropperRotateLeft" class="btn btn-primary btn-sm" data-toggle="tippy" data-title="Rotasi Kiri"><i class="fa fa-undo"></i></button>
                      <button id="cropperRotateRight" class="btn btn-primary btn-sm" data-toggle="tippy" data-title="Rotasi Kanan "><i class="fa fa-redo"></i></button>
                    </div>
                  </div>
                  <hr>
                  <div class="d-flex justify-content-center">
                    <div class="btn-group">
                      {{-- // HOLD tambah change photo button --}}
                      <button class="btn btn-success image-cropper-btn" data-toggle="tippy" data-title="Oke Siap!"><i class="fa fa-check-circle"></i> Potong</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-lg-start">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i>&#09;Batalkan</button>
        <button type="submit" class="btn btn-primary btn-promo-submit" form="formPromo"><i class="fa fa-plus-circle"></i>&#09;Tambahkan Promo</button>
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="token_csrf" value="{{ csrf_token() }}">
<input type="hidden" name="spinner" value="{{ asset('images/default/spinner.svg') }}">
<input type="hidden" name="image_default" value="{{ asset('images/default/image.svg') }}">
<input type="hidden" name="url_formAdd" value="{{ route('admin.promo.add') }}">
<input type="hidden" name="url_formEdit" value="{{ route('admin.promo.edit') }}">
<input type="hidden" name="url_get" value="{{ route('admin.promo.get') }}">
<input type="hidden" name="url_getOnce" value="{{ route('admin.promo.getOnce') }}">
<input type="hidden" name="url_gallery" value="{{ url('storage/') }}">
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/promo.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/admin/_admin.js') }}"></script>
{{-- jquery validate --}}
<script src="{{ asset('js/admin/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/admin/jquery-validate/additional-methods.min.js') }}"></script>
{{-- promo scripts --}}
<script src="{{ asset('js/admin/promo_plugins.js') }}"></script>
<script src="{{ asset('js/admin/promo.js') }}"></script>
@endsection