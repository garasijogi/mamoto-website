@extends('adminlte::page')

@section('title', 'Kelola Portfolio - Tambah')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@include('layouts.css.al-styles')
@endsection

@section('content_header')
<h1 class="px-4 mt-2">Tambah Portfolio</h1>
@endsection

@section('content')
{{-- form create portfolio --}}
<div class="row px-4">
  <div class="col-7 pr-4 border-right">
    <form action="/admin/portfolio/store" method="post" class="mb-4" enctype="multipart/form-data">
      @csrf
      {{-- nama --}}
      <div class="form-group mb-2">
        <label for="name" class="font-weight-bold">Nama Portfolio</label>
        <input type="text" name="name" id="name" placeholder="Masukkan Nama Portfolio" value="{{ old('name') ?? '' }}"
          class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <div class="text-danger mt-2">
          {{ $message }}
        </div>
        @enderror
      </div>

      {{-- jenis portfolio --}}
      <div class="form-group mb-2">
        <label for="exampleFormControlSelect1">Jenis Portfolio</label>
        <select name="pfType_id" class="form-control" id="exampleFormControlSelect1">
          <option disabled selected>Pilih Jenis Portfolio</option>
          <option value='W'>Wedding</option>
          <option value='preW'>Pre-Wedding</option>
          <option value="S">Siraman/Pengajian</option>
          <option value="L">Lamaran</option>
        </select>
        @error('pfType_id')
        <div class="text-danger mt-2">
          Jenis portfolio harus dipilih
        </div>
        @enderror
      </div>

      {{-- photo --}}
      <div id="photoSelector" class="form-group mb-2">
        <label for="fileList">Photo</label>
        <div class="custom-file">
          <input type="file" name="fileList[]" onchange="savePhoto(this);" class="custom-file-input"
            id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" multiple>
          <label class="custom-file-label" for="inputGroupFile01">Pilih file</label>
        </div>
        @error('fileList')
        <div class="text-danger mt-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div id='al-showPhotoNameDiv' class='d-none' style="max-height:43vh;overflow:auto">
        <ul id='al-showPhotoName' class="d-none"></ul>
      </div>

      {{-- video --}}
      <div class="form-group my-2">
        <label for="videoList">Video</label>
        <div class="custom-file">
          <input type="file" name="videoList" class="custom-file-input" id="inputGroupFile02"
            aria-describedby="inputGroupFileAddon01">
          <label class="custom-file-label" for="inputGroupFile02">Pilih file</label>
        </div>
        @error('videoList')
        <div class="text-danger mt-2">
          {{ $message }}
        </div>
        @enderror
      </div>

      {{-- details portfolio --}}
      <hr>
      <h6 class="mt-4 font-weight-bold">Portfolio Details</h6>
      <div class="row">
        <div class="col-sm">
          <div class="form-group mb-2">
            <label for="venue" class="font-weight-normal">Venue</label>
            <input type="text" name="venue" id="venue" placeholder="Masukkan Nama Venue"
              value="{{ old('venue') ?? '' }}" class="form-control @error('venue') is-invalid @enderror">
            @error('venue')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group mb-2">
            <label for="pv" class="font-weight-normal">Photo & Video</label>
            <input type="text" name="pv" id="pv" placeholder="Masukkan Pengelola Photo & Video"
              value="{{ old('pv') ?? '' }}" class="form-control @error('pv') is-invalid @enderror">
            @error('pv')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <div class="form-group mb-2">
            <label for="makeup" class="font-weight-normal">Make Up</label>
            <input type="text" name="makeup" id="makeup" placeholder="Masukkan Nama Pengelola Make Up"
              value="{{ old('makeup') ?? '' }}" class="form-control @error('makeup') is-invalid @enderror">
            @error('makeup')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group mb-2">
            <label for="decoration" class="font-weight-normal">Decoration</label>
            <input type="text" name="decoration" id="decoration" placeholder="Masukkan Nama Pengelola Dekorasi"
              value="{{ old('decoration') ?? '' }}" class="form-control @error('decoration') is-invalid @enderror">
            @error('decoration')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm">
          <div class="form-group mb-2">
            <label for="attire" class="font-weight-normal">Attire</label>
            <input type="text" name="attire" id="attire" placeholder="Masukkan Nama Pengelola Attire"
              value="{{ old('attire') ?? '' }}" class="form-control @error('attire') is-invalid @enderror">
            @error('attire')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group mb-2">
            <label for="henna" class="font-weight-normal">Henna</label>
            <input type="text" name="henna" id="henna" placeholder="Masukkan Nama Pengelola Henna"
              value="{{ old('henna') ?? '' }}" class="form-control @error('henna') is-invalid @enderror">
            @error('henna')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm">
          <div class="form-group mb-2">
            <label for="wo" class="font-weight-normal">Wedding Organizer</label>
            <input type="text" name="wo" id="wo" placeholder="Masukkan Nama Wedding Organizer"
              value="{{ old('wo') ?? '' }}" class="form-control @error('wo') is-invalid @enderror">
            @error('wo')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group mb-2">
            <label for="lighting" class="font-weight-normal">Lighting</label>
            <input type="text" name="lighting" id="lighting" placeholder="Masukkan Nama Pengelola Lighting"
              value="{{ old('lighting') ?? '' }}" class="form-control @error('lighting') is-invalid @enderror">
            @error('lighting')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>

      {{-- date --}}
      <div class="form-group mb-2">
        <label for="date" class="font-weight-normal">Tanggal</label>
        <div class="form-group">
          <div class='input-group date' id='datetimepicker1'>
            <div class="input-group-prepend">
              <span class="input-group-text" id="validationTooltipUsernamePrepend"> <i class="fas fa-calendar-alt"></i>
              </span>
            </div>
            <input type='text' class="form-control" name="date" placeholder="Masukkan Tanggal Acara"
              autocomplete="off" />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>
        </div>
        @error('date')
        <div class="text-danger mt-2">
          {{ $message }}
        </div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary mt-2">Tambah Portfolio</button>
    </form>
  </div>
  <div class="col-5 d-flex justify-content-center" style="max-height: 80vh; overflow:auto;">
    <h6 id='al-photoBox' class="text-center" style="line-height: 55vh">Belum ada foto untuk ditampilkan</h6>
    <div class="text-center">
      <div id='al-imageList' class="p-4 position-relative">
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
@include('layouts.js.al-scripts')
@endsection