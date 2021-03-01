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
                    <input type="text" class="form-control contact-input" value="{{ $value->contact }}">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary btn-flat contact-submit"><i class="fa fa-save"></i>
                        save</button>
                    </span>
                  </div>
                </td>
              </tr>
              @endforeach
              <tr>
                <td>sadwqafwq</td>
                <td class="contact-edit" data-id="12334"></td>
              </tr>
              <tr>
                <td>sadwqafwq</td>
                <td class="contact-edit" data-id="12334">
                  <p class="m-0 text-contact">jkfehsrgikewsfew</p>
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control contact-input" data-id="1234">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary btn-flat contact-submit"><i class="fa fa-save"></i>
                        save</button>
                    </span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('css')
    
@endsection

@section('js')
  <script src="{{ asset('js/admin/_admin.js') }}"></script>
  <script src="{{ asset('js/admin/contact_plugins.js') }}"></script>
  <script src="{{ asset('js/admin/contact.js') }}"></script>
@endsection