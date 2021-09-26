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
                            <button type="button" class="btn btn-sm btn-primary collapsible" data-toggle="modal"
                                data-target="#ns-details-{{ $feedback->id }}" aria-expanded="false"
                                aria-controls="ns-details-{{ $feedback->id }}">
                                <i class="fas fa-fw fa-info"></i>Detail</button>
                            <button type="button" class="btn btn-sm btn-warning ml-2" data-toggle="modal"
                                data-target="#ns-edit-{{ $feedback->id }}" aria-expanded="false"
                                data-aria-controls="ns-edit-{{ $feedback->id }}">
                                <i class="fas fa-fw fa-edit"></i>Edit</button>
                            <button type="button" class="btn btn-sm btn-danger ml-2" data-toggle="modal"
                                data-target="#ns-delete-{{ $feedback->id }}" aria-expanded="false"
                                data-aria-controls="ns-delete-{{ $feedback->id }}">
                                <i class="fas fa-fw fa-trash"></i>Delete</button>
                        </td>
                    </tr>

                    {{-- Detail Modal --}}
                    <div class="modal fade" tabindex="-1" id="ns-details-{{ $feedback->id }}">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Feedback</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="font-weight-bold">Kesan dan Pesan</p>
                                    <p>{{ $feedback->kesan_pesan }}</p>
                                    <p class="font-weight-bold">Kritik dan Saran</p>
                                    <p>{{ $feedback->kritik_saran }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Edit Modal --}}
                    <div class="modal fade" tabindex="-1" id="ns-edit-{{ $feedback->id }}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="/admin/feedback/edit/{{ $feedback->id }}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Feedback</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="ns-label">Mempelai Pria</label>
                                            <input type="text" class="form-control" name="mempelai_pria"
                                                value="{{ $feedback->mempelai_pria }}">
                                            @error('mempelai_wanita')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="ns-label">Mempelai Wanita</label>
                                            <input type="text" class="form-control" name="mempelai_wanita"
                                                value="{{ $feedback->mempelai_wanita }}">
                                            @error('mempelai_wanita')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="ns-label">Kesan Menggunakan Jasa Mamoto Picture :
                                            </label>
                                            @error('kesan_pesan')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <textarea class="form-control" rows="8"
                                                name="kesan_pesan">{{ $feedback->kesan_pesan }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="ns-label">Kritik dan Saran</label>
                                            @error('kritik_saran')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <textarea class="form-control" rows="8"
                                                name="kritik_saran">{{ $feedback->kritik_saran }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Delete Modal --}}
                    <div class="modal fade" tabindex="-1" id="ns-delete-{{ $feedback->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Feedback</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin akan menghapus data ini?
                                </div>
                                <div class="modal-footer">
                                    <form action="/admin/feedback/delete/{{ $feedback->id }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Iya</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection
