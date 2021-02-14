@extends('adminlte::page')

@section('title', 'Kelola About')

@section('content_header')
<h1>Kelola About</h1>
@endsection

@section('content')
{{-- <p>{{ $about }}</p> --}}
<div class="card">
	<div class="card-body">
		<div class="d-flex justify-content-end mb-2">
			<div>
				{{-- <button data-toggle="modal" data-target="#modalGallery" class="btn btn-info"><i class="fa fa-images" title="Tambah/Hapus gambar"></i> Images Gallery</button> --}}
				<button id="showGallery" class="btn btn-info" title="Tambah/Hapus gambar"><i class="fa fa-images"></i> Images Gallery</button>
			</div>
			<div class="ml-2">
				{{-- <button type="submit" class="btn btn-primary" form="aboutForm"><i class="fa fa-save"></i> Save</button> --}}
				<button id="saveAbout" class="btn btn-secondary" title="Simpan Perubahanmu"><span class="saveIcon"><i class="fa fa-save"></i></span> Simpan</button>
			</div>
		</div>
		{{-- <form id="aboutForm" action="{{ route('admin.about.edit') }}" method="post"> --}}
			{{-- @csrf --}}
			<div class="form-group p-2 rounded">
				<label for="post">About Post</label>
				<textarea name="post" id="post" class="form-control" required data-msg="Please write something :)" rows="10" required>{{ $about->post }}</textarea>
			</div>

			{{-- token and url --}}
			<input type="hidden" name="token_csrf" value="{{ csrf_token() }}">
			<input type="hidden" name="about_url" value="{{ route('admin.about.edit') }}">
			<input type="hidden" name="upload_url" value="{{ route('admin.uploadGambar') }}">
			<input type="hidden" name="url_getIndex" value="{{ route('admin.uploadGetIndex') }}">
			<input type="hidden" name="url_path" value="{{ url('storage/gallery/about') }}">
		{{-- </form> --}}
	</div>
</div>

{{-- include jquery fileUpload --}}
@include('admin._partials.modal-gallery')
@endsection

{{-- don't use this, because it was outdated --}}
{{-- @section('plugins.Sweetalert2', true) --}}

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/admin/jquery-file-upload/jquery-file-upload.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/admin/about.css') }}">
@endsection

@section('js')
{{-- scripts --}}
{{-- <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script> --}}
<script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('vendor/summernote/lang/summernote-id-ID.min.js') }}"></script>
<script src="{{ asset('js/admin/summernote-gallery/summernote-gallery.min.js') }}"></script>
<script src="{{ asset('js/admin/jquery-file-upload/jquery-file-upload.min.js') }}"></script>
{{-- <script src="{{ asset('js/admin/summernote-custom/summernote.js') }}"></script> --}}
{{-- <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script> --}}

{{-- custom scripts --}}
<script src="{{ asset('js/admin/_admin.js') }}"></script>
<script src="{{ asset('js/admin/about.js') }}"></script>
@endsection