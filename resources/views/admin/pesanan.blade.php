@extends('adminlte::page')

@section('title', 'Kelola Pesanan')

@section('content_header')
    <h1>Kelola Pesanan</h1>
@endsection

@section('content')
    <div class="container">
        <table class="table mt-3">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Event</th>
                    <th scope="col">Status</th>
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
                        <td>
                            @if ($book->status == 0)
                                <span class="badge badge-warning">Belum diproses</span>
                            @else
                                <span class="badge badge-success">Sedang diproses</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-start">
                            <button type="button" class="btn btn-sm btn-primary collapsible" data-toggle="modal"
                                data-target="#detail-{{ $book->id }}">
                                <i class="fas fa-fw fa-info"></i> Detail</button>
                            <button type="button" class="btn btn-sm btn-warning ml-2">
                                <i class="fas fa-fw fa-edit"></i>Edit</button>
                            <button type="button" class="btn btn-sm btn-danger ml-2 btn-modal-delete"
                                data-id="{{ $book->id }}">
                                <i class="fas fa-fw fa-trash"></i>Delete</button>
                        </td>
                    </tr>
                    <div class="modal fade" tabindex="-1" id="detail-{{ $book->id }}">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Pesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid" id="data">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <ul class="list-group">
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <b>Nama : </b>
                                                        <p>{{ $book->name }}</p>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <b>No Telp : </b>
                                                        <p>{{ $book->phone }}</p>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <b>Email : </b>
                                                        <p>{{ $book->email }}</p>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <b>Tgl Booking : </b>
                                                        <p>
                                                            {{ \Carbon\Carbon::parse($book->booking_date)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p>Events :
                                                            @foreach (json_decode($book->events) as $e)
                                                                <li class="p-0"> {{ $e }} </li>
                                                            @endforeach
                                                        </p>
                                                        <p><b>Lokasi : </b></p>
                                                        <p>{{ Str::limit($book->location, 500) }}</p>
                                                        <p><b>Catatan : </b></p>
                                                        <p>{{ Str::limit($book->note, 500) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    @if ($book->status == 0)
                                        <form method="post" action="/admin/pesanan/change-status/{{ $book->id }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Proses Pesanan</button>
                                        </form>
                                    @endif
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <tr>
                    <td colspan="6">
                        <div class="d-flex justify-content-center">
                            {{ $books->links() }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal fade" tabindex="-1" id="delete">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <form action="" method="post" id="btn-delete">
                            @csrf
                            <button type="submit" class="btn btn-primary">Iya</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).on('click', '.btn-modal-delete', function() {
            let id = $(this).data('id');
            let form = $('#btn-delete')
            $('#delete').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });

            form.attr('action', '/admin/pesanan/' + id + '/delete');
            console.log(form)
        })

    </script>
@endsection
