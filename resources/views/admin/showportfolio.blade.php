@extends('adminlte::page')

@section('title', 'Kelola Portfolio')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@include('layouts.css.al-styles')

@section('content_header')
<h1 class="px-4">{{ucfirst($portfolio->name)}}</h1>
@endsection

@section('content')
<div class="px-4">
  <div class="row">
    <div class="col-8">
      <div class="row">
        @foreach (json_decode($portfolio->photo) as $index => $photo)
        <div class="col-4 mb-2">
          <img width='100px' height='100px' style='object-fit:cover;'
            src="/storage/images/portfolio/{{$portfolio->pfType_id}}/{{$portfolio->slug}}/{{$photo->name}}"
            alt="Card image cap">
        </div>
        @endforeach
      </div>
    </div>
    <div class="col-4">

    </div>
  </div>
</div>
@endsection