@extends('layouts.app')
@section('title')
Portfolio - {{$title}}
@endsection
@section('content')
<div class="al-container d-block">
  {{-- big title --}}
  <div class="d-flex justify-content-center al-big-title p-2">
    <div class="d-flex align-items-center text-center">
      <div class="position-relative">
        <h1 class="al-big-title-font">{{$title}}</h1>
        <div class="al-breadcrumb">
          <h6>Home > Portfolio > {{$title}}</h6>
        </div>
      </div>
    </div>
  </div>

  {{-- portfolio videos --}}
  @if ($portfolio->video)
    <div class="al-portfolio-cards mt-5">
      <div class="al-portfolio-cards-content text-center">
        @foreach (json_decode($portfolio->video) as $index => $video)
          <div class="mb-3">
            <iframe width="720" height="500" src="{{ str_replace("watch?v=", "/embed/", $video->link) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
          </div>
        @endforeach
      </div>
    </div>
  @endif

  {{-- portfolio cards --}}
  <div class="al-portfolio-cards {{ $portfolio->video ? "pt-0" : "" }}">
    <div class="al-portfolio-cards-content">
      @foreach (json_decode($portfolio->photo) as $index => $photo)
      <div class="col-12 px-5 py-4 al-portfolio-card text-center"
        data-aos="{{ $index > 0 ? ($index % 2 != 0 ?  'fade-left' : 'fade-right') : '' }}">
        <div id='{{$index}}' onclick="alImageView(this.id, 'id')">
          <img class='{{$index}}' width='720px' height='500px' style='object-fit:cover;'
            src="/storage/images/portfolio/{{$portfolio->pfType_id}}/{{$portfolio->slug}}/{{$photo->name}}"
            alt="{{$portfolio->name}}">
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection

@section('modals')
<!-- Image Viewer Modal -->
<div id="al-imageViewer" class="al-image-viewer-modal" style="padding-left: 5vw; padding-right: 5vw">
  <div class="row" style="width: 100%">
    <div class="col-8">
      <div class="row">
        <div class="col-11 p-0 justify-content-end d-flex">
          <!-- Modal Content (The Image) -->
          <div class="d-flex">
            <!-- The Close Button -->
            <img class="al-image-viewer-modal-content" id="al-imageViewed">
          </div>
        </div>
        <div class="col-1  pr-0 pl-4" style="width: 0.2em">
          <i class="al-close-btn fas fa-times fa-2x text-white"></i>
        </div>
      </div>
    </div>
    <div class="col-4" style="overflow: auto; height: 80vh">
      <div class="imageSelector px-2 d-flex justify-content-end">
        <div>
          @foreach (json_decode($portfolio->photo) as $index => $photo)
          <div class="col-12 px-0 py-2 al-portfolio-card text-center">
            <div id='{{$index}}' onclick="alImageView(this.id, 'id')">
              <img class='{{$index}}' width='220px' height='120px' style='object-fit:cover;'
                src="/storage/images/portfolio/{{$portfolio->pfType_id}}/{{$portfolio->slug}}/{{$photo->name}}"
                alt="{{$portfolio->name}}">
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
@include('layouts.js.al-scripts')
@endsection