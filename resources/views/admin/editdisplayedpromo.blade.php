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

        @if ($promos->count() > 0)
        @foreach ($promos as $promo)
        <div class="col-6 al-promo-card">
            <a href="/admin/displayed-promo/{{ $promo->id }}/add" class="text-dark">
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
        @else
        <h6 class="al-grey-color pl-2">
            Tidak ada data promo atau seluruh promo telah dipilih.
        </h6>
        @endif

    </div>
</div>
@endsection

@section('js')
@include('layouts.js.al-scripts')
@endsection