@extends('adminlte::page')

@section('title', 'Kelola Promo')

@section('content_header')
<div class="d-flex justify-content-between">
  <div>
    <h1>Kelola Promo</h1>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-danger btn-promo-remove"><i class="fa fa-trash-alt"></i> Hapus Promo</button>
    <button type="button" class="btn btn-success btn-promo-add" data-toggle="modal" data-target="#staticBackdrop"><i
        class="fa fa-plus-circle"></i> Tambah Promo</button>
  </div>
</div>
@endsection

@section('content')

{{-- main content --}}
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-center mb-3">
      <div class="rr-image-container-noPromo" style="background-image: url({{ asset('images/default/discount.svg') }}); background-repeat: round;">
        {{-- <img class="rr-image-responsive" src="{{ asset('images/default/discount.svg') }}"alt="tidak ada promo yang ditambahkan"> --}}
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <p><b>Tidak ada Promo</b> yang ditambahkan.</p>
    </div>
  </div>
</div>

<!-- Modal tambah promo -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/promo.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/admin/_admin.js') }}"></script>
<script src="{{ asset('js/admin/promo.js') }}"></script>
@endsection