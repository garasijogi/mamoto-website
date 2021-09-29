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
                            <button type="button" class="btn btn-sm btn-warning ml-2" data-toggle="modal"
                                data-target="#edit-{{ $book->id }}">
                                <i class="fas fa-fw fa-edit"></i>Edit</button>
                            <button type="button" class="btn btn-sm btn-danger ml-2 btn-modal-delete"
                                data-id="{{ $book->id }}">
                                <i class="fas fa-fw fa-trash"></i>Delete</button>
                        </td>
                    </tr>

                    {{-- Modal Detail --}}
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

                    {{-- Modal Edit --}}
                    <div class="modal modal-edit fade" tabindex="-1" id="edit-{{ $book->id }}">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <form action="/admin/pesanan/{{ $book->id }}/edit" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Pesanan</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid" id="data">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <ul class="list-group">
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center row">
                                                            <b class="col-3">Nama : </b>
                                                            <input type="text"
                                                                class="col-9 form-control form-control-sm ns-form"
                                                                name="name" value="{{ $book->name }}">
                                                            @error('name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center row">
                                                            <b class="col-3">No Telp : </b>
                                                            <input type="text"
                                                                class="col-9 form-control form-control-sm ns-form"
                                                                value="{{ $book->phone }}" name="phone">
                                                            @error('phone')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center row">
                                                            <b class="col-3">Email : </b>
                                                            <input type="email"
                                                                class="col-9 form-control form-control-sm ns-form"
                                                                value="{{ $book->email }}" name="email">
                                                            @error('email')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center row">
                                                            <b class="col-3">Tgl Booking : </b>
                                                            <input
                                                                class="col-9 textbox-n form-control form-control-sm ns-form datepicker"
                                                                type="date" name="booking_date"
                                                                value="{{ old($book->booking_date, date('Y-m-d')) }}">
                                                            @error('booking_date')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                            <p>

                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <p>Events :</p>
                                                            @foreach ($events as $event)
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="{{ $event->id }}"
                                                                        value="{{ $event->name }}"
                                                                        name="event[{{ $event->id }}]"
                                                                        {{ $event->name ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="{{ $event->id }}">{{ $event->name }}</label>
                                                                </div>
                                                            @endforeach
                                                            @error('events')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                            <p><b>Lokasi : </b></p>
                                                            <textarea class="textbox-n form-control form-control-sm ns-form"
                                                                rows="5" name="location">
                                                                                                                                                                    {{ $book->location }}
                                                                                                                                                                </textarea>
                                                            @error('location')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                            <p><b>Catatan : </b></p>
                                                            <textarea class="textbox-n form-control form-control-sm ns-form"
                                                                rows="5" name="note">
                                                                                                                                                                    {{ $book->note }}
                                                                                                                                                                </textarea>
                                                            @error('location')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Edit Pesanan</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
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

        $('.modal-edit').on('shown.bs.modal', function() {
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection
