@extends('adminlte::page')

@section('title', 'Tambah User')

@section('content_header')
<h1 class="px-4">{{isset($submit) ? 'Edit User' : 'Tambah User'}}</h1>
@endsection

@section('content')
{{-- form create user --}}
<div class="row px-4">
  <div class="col-md-4">
    <form action="{{ isset($submit) ? '/admin/user/'.$user->username.'/edit' : '/admin/user/store'}}" method="post"
      enctype="multipart/form-data">
      @isset($submit)
      @method('patch')
      @endisset
      @csrf
      <div class="form-group mb-2">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" @if (isset($user))
          value="{{ old('username') ?? $user->username }}" @else value="{{ old('username') ?? '' }}" @endif
          class="form-control @error('username') is-invalid @enderror">
        @error('username')
        <div class="text-danger mt-2">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group mb-2">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" @if (isset($user)) value="{{ old('name') ?? $user->name }}" @else
          value="{{ old('name') ?? '' }}" @endif class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <div class="text-danger mt-2">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group mb-2">
        <label for="password">Password</label>
        <input type="password" name="password" id="password"
          class="form-control @error('password') is-invalid @enderror">
        @error('password')
        <div class="text-danger mt-2">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group mb-2">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
          class="form-control @error('password_confirmation') is-invalid @enderror">
        @error('password_confirmation')
        <div class="text-danger mt-2">
          {{ $message }}
        </div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary mt-2">{{ $submit ?? 'Tambah User'}}</button>
    </form>
  </div>
</div>
@endsection