@extends('adminlte::page')

@section('title', 'Tambah FAQ')

@section('content_header')
    <h1>Edit FAQ</h1>
@endsection

@section('content')
    <div class="container">
        <form action="/admin/faq/{{ $faq->id }}/edit" method="post">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="">Pertanyaan</label>
                <input type="text" name="question" class="form-control" placeholder="Pertanyaan"
                    value="{{ old('question', $faq->question) }}">
                @error('question')
                    <small class="text-danger text-sm">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Jawaban</label>
                <input type="text" name="answer" class="form-control" placeholder="Jawaban"
                    value="{{ old('question', $faq->answer) }}">
                @error('answer')
                    <small class="text-danger text-sm">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
@endsection
