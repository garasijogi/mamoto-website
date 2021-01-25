@extends('adminlte::page')

@section('title', 'Kelola User')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('content_header')
<h1 class="px-4">Kelola User</h1>
@endsection

@section('content')
<div class="px-4">
  <a href="{{route('admin.user.create')}}" class="btn btn-primary mb-3">Tambah User</a>
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
          <a href="/admin/user/{{$user->username}}/edit" class="text-primary"><i class="fas fa-fw fa-user-edit"></i></a>
          <button type="button" data-toggle="modal" data-target="#deleteModal" data-username="{{$user->username}}"
            class="al-deleteUser border-0 bg-transparent text-danger"><i class="fas fa-fw fa-trash"></i></button>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  @can('delete', $user)
  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin menghapusnya?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="delete-form" action="" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger mr-3" type="submit">Ya</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endcan
</div>
@endsection

@section('js')
@include('layouts.js.al-scripts')
@endsection