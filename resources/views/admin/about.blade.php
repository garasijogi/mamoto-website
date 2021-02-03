@extends('adminlte::page')

@section('title', 'Kelola About')

@section('content_header')
<h1>Kelola About</h1>
@endsection

@section('content')
<p>{{ $about }}</p>
<div class="card">
	<div class="card-body">
		<div class="d-flex justify-content-end mb-2">
			<div>
				{{-- <button type="submit" class="btn btn-primary" form="aboutForm"><i class="fa fa-save"></i> Save</button> --}}
				<button id="submitAbout" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
			</div>
		</div>
		{{-- <form id="aboutForm" action="{{ route('admin.about.edit') }}" method="post"> --}}
			{{-- @csrf --}}
			<div class="form-group p-2 rounded">
				<label for="post">About Post</label>
				<textarea name="post" id="post" class="form-control" required data-msg="Please write something :)" rows="10" required></textarea>
			</div>

			{{-- token and url --}}
			<input type="hidden" name="token_csrf" value="{{ csrf_token() }}">
			<input type="hidden" name="about_url" value="{{ route('admin.about.edit') }}">
		{{-- </form> --}}
	</div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
@endsection

@section('js')
{{-- scripts --}}
{{-- <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script> --}}
<script src="{{ asset('vendor/summernote/summernote-bs4.js') }}"></script>
{{-- <script src="{{ asset('js/admin/summernote-custom/summernote.js') }}"></script> --}}

<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

{{-- custom scripts --}}
<script src="{{ asset('js/admin/_admin.js') }}"></script>
<script src="{{ asset('js/admin/about.js') }}"></script>
@endsection