@extends('layouts.app')
@section('title', 'Mamoto Picture - Book Success!')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('books'))
                <div class="alert alert-success ns-message">
                    <h3>Terimakasih telah melakukan pemesanan.</h3>
                    <p>Kami akan menghubungi anda untuk pemberitahuan lebih lanjut</p>
                </div>
            @else
                <script type="text/javascript">
                    window.location = {{ url('/booknow') }}

                </script>
            @endif
        </div>
    </div>
@endsection
