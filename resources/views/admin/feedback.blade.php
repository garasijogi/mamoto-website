@extends('adminlte::page')

@section('title', 'Kelola Feedback')

@section('content_header')
    <h1>Kelola Feedback</h1>
@endsection

@section('content')

    <div class="container">
        <table class="table mt-3">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mempelai Pria</th>
                    <th scope="col">Mempelai Wanita</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp

                @foreach ($feedbacks as $feedback)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $feedback->mempelai_pria }}</td>
                        <td>{{ $feedback->mempelai_wanita }}</td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-sm btn-primary collapsible" data-toggle="collapse"
                                data-target="#ns-details{{ $feedback->id }}" aria-expanded="false"
                                aria-controls="ns-details{{ $feedback->id }}">
                                <i class="fas fa-fw fa-info"></i>Detail</button>
                            <button type="button" class="btn btn-sm btn-warning ml-2">
                                <i class="fas fa-fw fa-edit"></i>Edit</button>
                            <button type="button" class="btn btn-sm btn-danger ml-2">
                                <i class="fas fa-fw fa-trash"></i>Delete</button>
                        </td>
                    </tr>
                    <td colspan="4" class="collapse" id="ns-details{{ $feedback->id }}">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <div class="col-12">
                                    <p><b>Kesan dan Pesan : </b> {{ $feedback->kesan_pesan }}</p>
                                    <p><b>Kritik dan Saran : </b> {{ $feedback->kritik_saran }}</p>
                                </div>
                            </div>
                        </div>
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection
