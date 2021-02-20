@extends('adminlte::page')

@section('title', 'Kelola Promo')

@section('content_header')
<div class="d-flex justify-content-between">
  <div>
    <h1>Kelola Promo</h1>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-danger btn-promo-remove"><i class="fa fa-trash-alt"></i> Hapus Semua Promo</button>
    <button type="button" class="btn btn-success btn-promo-add" data-toggle="modal" data-target="#modal_promo"><i
        class="fa fa-plus-circle"></i> Tambah Promo</button>
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
        {{-- @for ($i = 0; $i < 11; $i++)
          <div class="col-lg-6 col">
            <div class="card mb-3" style="max-width: 100%">
              <div class="row no-gutters">
                <div class="col-lg-5 col-md-4">
                  <img class="rr-image-responsive" src="{{ "https://picsum.photos/id/".rand(0, 99)."/1080" }}"
                    alt="{{ "https://picsum.photos/id/".rand(0, 99)."/1080" }}">
                </div>
                <div class="col-lg-7 col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text mb-0">This is a wider card with supporting text below as a natural lead-in to additional content.
                      This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">ditambahkan '+timestamp+'</small></p>
                    <div class="d-flex justify-content-end">
                      <div class="btn-group">
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        <button class="btn btn-primary"><i class="fa fa-eye"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endfor --}}
        {{-- <div class="col-lg-6 col">
          <div class="card mb-3" style="max-width: 100%">
            <div class="row no-gutters">
              <div class="col-lg-5 col-md-4">
                <img class="rr-image-responsive" src="'+url_gallery+value.photo+'" alt="Poster Promo -> '+value.name+'">
              </div>
              <div class="col-lg-7 col-md-8">
                <div class="card-body">
                  <h5 class="card-title">'+value.name+'</h5>
                  <p class="card-text mb-0">'value.post'</p>
                  <p class="card-text"><small class="text-muted">Ditambahkan '+timestamp+'</small></p>
                  <div class="d-flex justify-content-end">
                    <div class="btn-group" data-id="'+value.id+'">
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
      <div class="modal-header">
        <h5 class="modal-title" id="modal_promoLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6">
            <form id="formAddPromo" action="#" method="post" novalidate>
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
          <div class="col-lg-6">
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
                      {{-- // TODO tambah change photo button --}}
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
        <button type="submit" class="btn btn-primary" form="formAddPromo"><i class="fa fa-plus-circle"></i>&#09;Tambahkan Promo</button>
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="token_csrf" value="{{ csrf_token() }}">
<input type="hidden" name="spinner" value="{{ asset('images/default/spinner.svg') }}">
<input type="hidden" name="image_default" value="{{ asset('images/default/image.svg') }}">
<input type="hidden" name="url_formAdd" value="{{ route('admin.promo.add') }}">
<input type="hidden" name="url_get" value="{{ route('admin.promo.get') }}">
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