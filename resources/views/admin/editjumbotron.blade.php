@extends('adminlte::page')

@section('title', 'Kelola Home')

@section('content_header')
<h1 class="px-4 mt-2">Edit Jumbotron</h1>
@endsection

@section('css')
@include('layouts.css.al-styles')
@endsection

@section('content')
<div class="px-4">
    {{-- foto 1 --}}
    @foreach ($jumbotrons as $index => $jumbotron)
    <div class="row mb-4">
        <div class="col border-bottom mb-2">
            <h6 class="font-weight-bold">Foto {{ $index+1 }}</h6>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <img id="jumbo{{ $index+1 }}" width="350px" height="200px"
                        style="display: block;object-fit: contain;max-width:100%" src="{{ $jumbotron->path }}"
                        alt="Jumbotron {{ $index+1 }}">
                </div>
                <div class="col-8">
                    {{-- photo --}}
                    <form action="/admin/jumbotron/{{ $jumbotron->id }}/edit" method="post" class="mb-4"
                        enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group mb-2">
                            <h6>Ganti Foto</h6>
                            <div class="custom-file">
                                <input id='upload_{{ $index+1 }}' type="file" name="jumbo1"
                                    class="custom-file-input image" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01">
                                <input type="hidden" name="jumbo{{ $index+1 }}cropped" id="inputjumbo{{ $index+1 }}">
                                <label class="custom-file-label" for="inputGroupFile01">Pilih file</label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('modals')
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="img-container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                            <img id="image" src="" alt='Your image'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('layouts.js.al-scripts')
@endsection