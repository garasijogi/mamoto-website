@extends('adminlte::page')

@section('title', 'Kelola Portfolio')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@include('layouts.css.al-styles')

@section('content_header')
<h1 class="px-4 mt-2">{{ucfirst($portfolio->name)}}</h1>
@endsection

@section('content')
<div class="px-4 h-100">
  <div class="row">
    <div class="col-8">
      <div class="row">
        @foreach (json_decode($portfolio->photo) as $index => $photo)
        <div class="col-6 my-2 d-flex justify-content-center">
          <div id='{{$index}}' onclick="imageView(this.id)">
            <img class='{{$index}} al-thumbnail' width='300px' height='200px' style='object-fit:cover;'
              src="/storage/images/portfolio/{{$portfolio->pfType_id}}/{{$portfolio->slug}}/{{$photo->name}}"
              alt="Card image cap">
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="col-4 border-left pl-4">
      <h5>Portfolio Details</h6>
        <div class="row">
          <div class="col">
            <h6>Jenis Portfolio</h6>
          </div>
          <div class="col">
            <h6 class="text-secondary">{{$jenis_portfolio}}</h6>
          </div>
        </div>
        @foreach (json_decode($portfolio->details) as $key => $d)
        <div class="row">
          <div class="col">
            <h6>{{ucwords(str_replace('-', ' ', $key))}}</h6>
          </div>
          <div class="col">
            <h6 class="text-secondary">{{ucfirst($d)}}</h6>
          </div>
        </div>
        @endforeach
        <div class="row mt-2">
          <div class="col">
            <a href="#" class="btn btn-primary">Edit</a>
            <a href="#" class="btn btn-danger">Delete</a>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection

@section('modals')
<!-- The Modal -->
<div id="al-imageViewer" class="al-image-viewer-modal">

  <!-- The Close Button -->
  <i class="al-close-btn fas fa-times fa-2x text-white"></i>

  <!-- Modal Content (The Image) -->
  <img class="al-image-viewer-modal-content" id="al-imageViewed">
</div>
@endsection

@section('js')
@include('layouts.js.al-scripts')
@endsection