@extends('adminlte::page')

@section('title', 'Kelola Home')

@section('content_header')
<h1 class="px-4 mt-2">Pilih Portfolio Wedding yang Ingin Ditampilkan</h1>
@endsection

@section('css')
@include('layouts.css.al-styles')
@endsection

@section('content')
<div class="px-4">
    <div class="row pb-2">
        <div class="col-12">
            <h6>Dipilih: <span class="text-primary selected-portfolio"> - </span></h6>
        </div>
        <div class="col-12">
            <button class="btn btn-sm btn-primary submit-form">Simpan</button>
        </div>
    </div>
    <div class="row">
        <form method="post" action="" name="selected_portfolio_form" id="selected_portfolio_form">
            @method('patch')
            @csrf
            <input id="selected_portfolio" type="hidden" name="selected_portfolio">
        </form>
        @forelse ($portfolios as $p)
        <div class="col-4">
            <div class="card p-2 al-portfolio-card selected" style="width: 18rem;" data-pftype="{{ $pftype }}"
                data-id="{{ $p->id }}" data-name="{{ $p->name }}">
                <div class="row">
                    @if (count(json_decode($p->photo)) >= 4)
                    @foreach (array_slice(json_decode($p->photo), 0, 4) as $index => $photo)
                    <div class="col-6 mb-2">
                        <img class="card-img-top" width='100px' height='100px' style='object-fit:cover;'
                            src="/storage/images/portfolio/{{$p->pfType_id}}/{{$p->slug}}/{{$photo->name}}"
                            alt="Card image cap">
                    </div>
                    @endforeach
                    @elseif (count(json_decode($p->photo)) == 3)
                    @foreach (array_slice(json_decode($p->photo), 0, 3) as $index => $photo)
                    @if ($index == 2)
                    <div class="col-12 mb-2">
                        <img class="card-img-top" width='100px' height='100px' style='object-fit:cover;'
                            src="/storage/images/portfolio/{{$p->pfType_id}}/{{$p->slug}}/{{$photo->name}}"
                            alt="Card image cap">
                    </div>
                    @else
                    <div class="col-6 mb-2">
                        <img class="card-img-top" width='100px' height='100px' style='object-fit:cover;'
                            src="/storage/images/portfolio/{{$p->pfType_id}}/{{$p->slug}}/{{$photo->name}}"
                            alt="Card image cap">
                    </div>
                    @endif
                    @endforeach
                    @elseif (count(json_decode($p->photo)) == 2)
                    @foreach (array_slice(json_decode($p->photo), 0, 2) as $index => $photo)
                    <div class="col-6 mb-2 pb-2">
                        <img class="card-img-top" width='100px' height='200px' style='object-fit:cover;'
                            src="/storage/images/portfolio/{{$p->pfType_id}}/{{$p->slug}}/{{$photo->name}}"
                            alt="Card image cap">
                    </div>
                    @endforeach
                    @else
                    @foreach (array_slice(json_decode($p->photo), 0, 1) as $index => $photo)
                    <div class="col-12 mb-2">
                        <img class="card-img-top" width='100px' height='200px' style='object-fit:cover;'
                            src="/storage/images/portfolio/{{$p->pfType_id}}/{{$p->slug}}/{{$photo->name}}"
                            alt="Card image cap">
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="card-body py-0 px-1 text-center">
                    <h6>
                        {{mb_strimwidth(ucfirst($p->name), 0, 30, "...")}}
                    </h6>
                    <small>{{date("d-m-Y", strtotime($p->date))}}</small>
                </div>
            </div>
        </div>
        @empty
        <div class="col">
            <p>Tidak ada portfolio.</p>
        </div>
        @endforelse
    </div>
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