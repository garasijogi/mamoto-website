@extends('layouts.app')
@section('title', 'Mamoto Picture - About')
@section('content')
<div class="al-container d-block al-wedding-ring-bg al-min-height-39">
  {{-- title --}}
  <h1 class="rr-header text-center mb-5">About Us</h1>
  
  {{-- content --}}
  <div class="rr-content container">
    <div class="row">
      <div class="col">
        {!! $about->post !!}
      </div>
    </div>
  </div>
</div>
@endsection

@section('css-ryu')
<link rel="stylesheet" href="{{ asset('css/rr.css') }}">
<link rel="stylesheet" href="{{ asset('css/algorithm/styles.css') }}">
@endsection