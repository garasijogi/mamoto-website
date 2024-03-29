@extends('adminlte::page')

@section('title', 'Kelola Kontak')

@section('content_header')
	<h1>Kelola About</h1>
@endsection

@section('content')
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body table-responsive">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>Nama Kontak</th>
                <th>Kontak</th>
                <th data-toggle="tippy" data-title="Text yang akan tampil pada halaman kontak">Text</th>
                <th data-toggle="tippy" data-title="Untuk mengarahkan pengguna menuju halaman sosial media dipilih">Link</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($lists as $value)
              <tr>
                <td><i class="{{ $value->logo }}"></i> {{ $value->name }}</td>
                <td>
                  <p class="m-0 contact-edit" data-id="{{ $value->name }}" data-toggle="tippy" data-title="Klik untuk edit">
                    {{ $value->contact }}</p>
                  <div class="input-group input-group-sm input-group-contact" style="display: none">
                    <input type="text" class="form-control input-edit" value="{{ $value->contact }}" data-input="contact">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary btn-flat contact-submit"><i class="fa fa-save"></i>
                        save</button>
                    </span>
                  </div>
                </td>
                <td>
                  <p class="m-0 contact-edit" data-id="{{ $value->name }}" data-toggle="tippy" data-title="Klik untuk edit">
                    {{ $value->text }}</p>
                  <div class="input-group input-group-sm input-group-contact" style="display: none">
                    <input type="text" class="form-control input-edit" value="{{ $value->text }}" data-input="text">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary btn-flat contact-submit"><i class="fa fa-save"></i>
                        save</button>
                    </span>
                  </div>
                </td>
                <td>
                  <p class="m-0 contact-edit" data-id="{{ $value->name }}" data-toggle="tippy" data-title="Klik untuk edit">
                    {{ $value->link }}</p>
                  <div class="input-group input-group-sm input-group-contact" style="display: none">
                    <input type="text" class="form-control input-edit" value="{{ $value->link }}" data-input="link">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary btn-flat contact-submit"><i class="fa fa-save"></i>
                        save</button>
                    </span>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

	<input type="hidden" name="token_csrf" value="{{ csrf_token() }}">
	<input type="hidden" name="url_save" value="{{ route('admin.contact.save') }}">
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin/contact.css') }}">
@endsection

@section('js')
  <script src="{{ asset('js/admin/_admin.js') }}"></script>
  <script src="{{ asset('js/admin/contact_plugins.js') }}"></script>
  <script src="{{ asset('js/admin/contact.js') }}"></script>
@endsection