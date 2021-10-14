@extends('layouts.app')
@section('title')
Portfolio - {{$title}}
@endsection
@section('content')
<div class="al-container d-block al-home">
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

  {{-- portfolio cards --}}
  <div class="al-portfolio-cards">
    <div class="al-portfolio-cards-content">
      <div class="row d-flex justify-content-center">
        @if($portfolios->isEmpty())
        <h6 class="py-5 al-grey-color">Belum ada Portfolio untuk ditampilkan.</h6>
        @endif
        @foreach ($portfolios as $portfolio)
        @foreach (array_slice(json_decode($portfolio->photo), 0, 1) as $index => $photo)
        <div class="col-6 px-5 al-portfolio-card text-center" data-aos="{{ $index > 0 ? 'fade-up' : '' }}">
          <a href="/portfolio/{{ $portfolio->pfType_id }}/{{ $portfolio->slug }}" class="d-block text-decoration-none">
            <img width='420px' height='350px' style='object-fit:cover;'
              src="/storage/images/portfolio/{{$portfolio->pfType_id}}/{{$portfolio->slug}}/{{$photo->name}}"
              alt="{{$portfolio->name}}">
            <h3 class="py-2 text-center al-font-portfolio-name al-grey-color">{{$portfolio->name}}</h3>
            <h6 class="text-center al-grey-color al-font1 font-weight-bold">
              {{date("d . m . Y", strtotime($portfolio->date))}}
              | {{ json_decode($portfolio->details)->location }}</h6>
          </a>
        </div>
        @endforeach
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection