@extends('layouts.app')
@section('title', 'Mamoto Picture - About')
@section('content')
{{-- title --}}
<h1 class="rr-about-header text-center mb-5">About Us</h1>

{{-- content --}}
<div class="rr-about-content container">
  <div class="row">
    <div class="col">
      {!! $about->post !!}
    </div>
  </div>
</div>
@endsection

@section('css-ryu')
  <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection