@extends('adminlte::page')

@section('title', 'Kelola User')

@section('content_header')
<h1>Kelola User</h1>
@endsection

@section('content')
<a href="" class="btn btn-primary mb-3">Tambah User</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Nama</th>
      <th scope="col">Username</th>
      <th class="text-center" scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <th scope="row">{{ (($loop->index)+1) }}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->username}}</td>
      <td class="d-flex justify-content-around">
        <a href="#" class="text-primary"><i class="fas fa-fw fa-user-edit"></i></a>
        <a href="#" class="text-danger"><i class="fas fa-fw fa-trash"></i></a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@endsection