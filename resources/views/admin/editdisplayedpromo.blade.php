@extends('adminlte::page')

@section('title', 'Kelola Home')

@section('content_header')
<h1 class="px-4 mt-2">Pilih Promo yang Ingin Ditampilkan</h1>
@endsection

@section('css')
@include('layouts.css.al-styles')
@endsection

@section('content')
<div class="px-4">
    <div class="row">

        @foreach ($promos as $promo)
        <div class="col-6 al-promo-card">
            <a href="/admin/displayed-promo/{{ $promo->id }}/edit" class="text-dark">
                <div class="card">
                    <div class="row">
                        <div class="col-6">
                            <img class="card-img-top" src="{{ '/storage/'.$promo->photo }}" alt="Card image cap">
                        </div>
                        <div class="col-6">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">{{ $promo->name }}</h5>
                                <p class="card-text">
                                    {{ strlen($promo->post) > 200 ? substr($promo->post, 0, 200) . '...' : $promo->post }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach

    </div>
</div>
@endsection

@section('js')
@include('layouts.js.al-scripts')
@endsection