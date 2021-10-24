@extends('layouts.app')
@section('title', 'Mamoto Picture - Feedback')
@section('content')
<div class="al-container d-block">
    <div class="container">
        <div class="text-center ns-faq-title">
            <h1 class="ns-title">Mamoto Picture Testimoni</h1>
        </div>
        @if (session('success'))
            <div class="alert alert-success ns-message">
                <h3>{{ session('success') }}</h3>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12"></div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <form action="/feedback/post" method="post">
                    @csrf
                    <div class="form-group text-center">
                        <label class="ns-label">Mempelai Pria</label>
                        <input type="text" class="form-control" name="mempelai_pria">
                        @error('mempelai_wanita')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <label class="ns-label">Mempelai Wanita</label>
                        <input type="text" class="form-control" name="mempelai_wanita">
                        @error('mempelai_wanita')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <p class="text-center ns-fb-greet">Terimakasih telah menggunakan Jasa Wedding Photography Mamoto
                        Picture.
                        Silahkan berikan penilaian berdasarkan pengalaman anda bekerjasama dengan kami. Terima kasih :)</p>

                    <div class="form-group text-center">
                        <label class="ns-label">Kesan Menggunakan Jasa Mamoto Picture : <sup>(Jawaban dari bagian ini dapat
                                muncul dalam website kami)</sup> </label>
                        @error('kesan_pesan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <textarea class="form-control" rows="8" name="kesan_pesan"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <label class="ns-label">Kritik dan Saran</label>
                        @error('kritik_saran')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <textarea class="form-control" rows="8" name="kritik_saran"></textarea>
                    </div>
                    <button type="submit" class="btn mb-2 px-5 mx-auto d-block ns-submit mb-5">Kirim</button>
                </form>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12"></div>
        </div>
    </div>
</div>
@endsection
