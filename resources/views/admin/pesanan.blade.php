@extends('adminlte::page')

@section('title', 'Kelola Pesanan')

@section('content_header')
    <h1>Kelola Pesanan</h1>
@endsection

@section('content')
    <div class="container">
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
                            <button type="button" class="btn btn-sm btn-primary collapsible" data-toggle="collapse"
                                data-target="#ns-details{{ $book->id }}" aria-expanded="false"
                                aria-controls="ns-details{{ $book->id }}">
                                <i class="fas fa-fw fa-info"></i> Detail</button>
                        </td>
                    </tr>
                    <td colspan="5" class="collapse" id="ns-details{{ $book->id }}">
                        <div class="card text-white bg-info">
                            <div class="row card-body">
                                <div class="col-lg-6 col-md-12">
                                    <p><b>Nama : </b> {{ $book->name }}</p>
                                    <p><b>No Telp : </b> {{ $book->phone }}</p>
                                    <p><b>Email : </b> {{ $book->email }}</p>
                                    <p><b>Tgl Booking : </b> {{ $book->booking_date }}</p>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <p>Events :
                                        @foreach (json_decode($book->events) as $e)
                                            <li class="p-0"> {{ $e }} </li>
                                        @endforeach
                                    </p>
                                    <p>Lokasi : {{ $book->location }}</p>
                                    <p>Catatan : {{ $book->note }}</p>
                                </div>
                            </div>
                        </div>
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script>
        function showDetails(data) {
            var content = document.getElementsByClassName('');
            console.log(data)
        }

    </script>
@endsection
