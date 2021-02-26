@extends('adminlte::page')

@section('title', 'Kelola Pesanan')

@section('content_header')
    <h1>Kelola Pesanan</h1>
@endsection

@section('content')
    <div class="container">
        <a href="/admin/faq/create" class="btn btn-sm btn-primary">Tambah FAQ.</a>
        <table class="table mt-3 col-10">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Event</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp

                @foreach ($books as $book)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->email }}</td>
                        <td>
                            @foreach (json_decode($book->events) as $e)
                                <li class="p-0"> {{ $e }} </li>
                            @endforeach
                        </td>
                        <td class="d-flex justify-content-start">
                            <a href="" class="text-primary"><abbr title="Edit FAQ">
                                    <i class="fas fa-fw fa-edit"></i></abbr></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection
