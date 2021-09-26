@extends('adminlte::page')

@section('title', 'Kelola FAQ')

@section('content_header')
    <h1>Kelola FAQ</h1>
@endsection

@section('content')
    <div class="container">
        <a href="/admin/faq/create" class="btn btn-sm btn-primary">Tambah FAQ.</a>
        <table class="table mt-3 col-12">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pertanyaan</th>
                    <th scope="col">Jawaban</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($faqs as $faq)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td class="d-flex justify-content-start">
                            <a href="/admin/faq/{{ $faq->id }}/edit " class="text-primary" title="Edit FAQ">
                                <i class="fas fa-fw fa-edit"></i></a>
                            <button type="button" class="border-0 bg-transparent text-danger" data-toggle="modal"
                                data-target="#deleteModal-{{ $faq->id }}" title="Delete FAQ">
                                <i class=" fas fa-fw fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    {{-- Modal Detail --}}
                    <div class="modal fade" id="deleteModal-{{ $faq->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus FAQ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin akan menghapus data {{ $faq->question }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                    <form action="/admin/faq/{{ $faq->id }}/delete" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-primary">Iya</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection
