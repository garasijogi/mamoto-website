@extends('layouts.app')
@section('title', 'Mamoto Picture - Promo')
@section('content')
<div class="al-container d-block">
  {{-- title --}}
  <h1 class="rr-header text-center mb-5">Promo</h1>
  
  {{-- content --}}
  <div class="container container-promo">
    <div class="row justify-content-around row-promo">
      {{-- no data --}}
      <div class="col-12 promo-noPromo" style="display: none;">
        <div class="d-flex justify-content-center">
          <div class="promo-noPromo-img" style="background-image: url({{ asset('images/default/discount.svg') }});"></div>
        </div>
        <div class="d-flex justify-content-center">
          <p><b>Tidak ada Promo</b> yang ditambahkan.</p>
        </div>
      </div>
      {{-- promo cards --}}
      {{-- @for ($i = 0; $i < 2; $i++)
        <div class="col-lg-4 promo-cards">
          <!-- image -->
          <div class="promo-img-container">
            <div class="promo-img" style="background-image: url(https://picsum.photos/1080);">
            </div>
          </div>
          <div>
            <div class="text-center">
              <h3 class="promo-title">
                PROMO SUPER
              </h3>
            </div>
            <p class="promo-description">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit maiores natus dolore minus. <br/><span><a href="#">more info</a></span>
            </p>
            <div class="d-flex justify-content-center">
              <div class="promo-btn" data-link="https://google.com">Book Now</div>
            </div>
          </div>
        </div>
      @endfor --}}
    </div>
    {{-- spinner --}}
    <div class="row promo-spinner">
      <div class="col-12">
        <div class="d-flex justify-content-center">
          <div class="bg-white promo-img-spinner-container">
            <img class="promo-img-spinner" src="{{ asset('images/default/spinner.svg') }}" alt="loading...">
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="showPromo" tabindex="-1" aria-labelledby="showPromoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        @include('layouts.overlay')
        <div class="modal-header">
          <h5 class="modal-title" id="showPromoLabel">Promo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col">
              <p id="promoPost">Keterangan Promo</p>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-auto">
              <div id="showPromo_btn" class="promo-btn" data-link="https://google.com">Book Now</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <input type="hidden" name="token_csrf" value="{{ csrf_token() }}">
  <input type="hidden" name="image_default" value="{{ asset('images/default/image.svg') }}">
  <input type="hidden" name="url_get" value="{{ route('promo.get') }}">
  <input type="hidden" name="url_getOnce" value="{{ route('promo.getOnce') }}">
</div>
@include('admin/_partials/modal-imageViewer')
@endsection

@section('css-ryu')
<link rel="stylesheet" href="{{ asset('css/rr.css') }}">
<link rel="stylesheet" href="{{ asset('css/promo.css') }}">
@endsection

@section('js-ryu')
<script src="{{ asset('js/promo.js') }}"></script>
@endsection