@extends('layouts.app')
@section('title', 'Mamoto Picture - Home')
@section('content')

<div id="jumbotron-carousel" class="carousel slide al-home-jumbotron al-full-content" data-ride="carousel">
    <div id='jumbotron'>

    </div>
    <div class="al-jumbotron-text-wrapper">
        <h6 class="al-jumbotron-text">Let's talk about your moment</h6>
    </div>
    <div class="carousel-inner">
        <div class="col-12 al-jumbotron al-jumbotron-carousel-1 al-container carousel-item active">

        </div>
        <div class="col-12 al-jumbotron al-jumbotron-carousel-2 al-container carousel-item">
        </div>
        <div class="col-12 al-jumbotron al-jumbotron-carousel-3 al-container carousel-item">
        </div>
        <div class="col-12 al-jumbotron al-jumbotron-carousel-4 al-container carousel-item">
        </div>

        <a class="carousel-control-prev" href="#jumbotron-carousel" role="button" data-slide="prev">
            <button class="al-arrow-left"></button>
        </a>
        <a class="carousel-control-next" href="#jumbotron-carousel" role="button" data-slide="next">
            <button class="al-arrow-right"></button>
        </a>
    </div>
</div>
<div>
    <div class="al-displayed-portfolios pt-4">
        <p class="text-center al-dp-title al-grey-color">
            Our Latest Project
        </p>
    </div>
    <div class="al-dp">
        @foreach ($displayed_portfolios as $index => $dp)
        @if (!empty($dp->portfolio))
        <a href="/portfolio/{{ $dp->portfolio->pfType_id }}/{{ $dp->portfolio->slug }}"
            class="d-block text-decoration-none">
            <div class="row al-dp-card {{ $index > 0 ? 'py-5' : 'pb-5 pt-3' }}">
                @if ($index % 2 != 0)
                <div class="col-4 align-self-center">
                    <h6 class="text-center al-grey-color al-font1 font-weight-bold">
                        @switch($dp->pfType_id)
                        @case('W')
                        Wedding
                        @break
                        @case('preW')
                        Pre-Wedding
                        @break
                        @case('S')
                        Siraman/Pengajian
                        @break
                        @case('L')
                        Lamaran
                        @break
                        @default
                        Data not found.
                        @endswitch
                    </h6>
                    <h3 class="py-2 text-center al-font-portfolio-name al-grey-color">{{$dp->portfolio->name}}</h3>
                    <h6 class="text-center al-grey-color al-font1 font-weight-bold">
                        {{date("d . m . Y", strtotime($dp->portfolio->date))}}
                        | Jakarta Timur
                    </h6>
                </div>
                @else
                <div class="col-8 text-right">
                    @foreach (array_slice(json_decode($dp->portfolio->photo), 0, 1) as $photo)
                    <img width='700px' height='400px' style='object-fit:cover;'
                        src="/storage/images/portfolio/{{$dp->pfType_id}}/{{$dp->portfolio->slug}}/{{$photo->name}}"
                        alt=" Card image cap">
                    @endforeach
                </div>
                @endif
                @if ($index % 2 != 0)
                <div class="col-8 text-right">
                    @foreach (array_slice(json_decode($dp->portfolio->photo), 0, 1) as $photo)
                    <img width='700px' height='400px' style='object-fit:cover;'
                        src="/storage/images/portfolio/{{$dp->pfType_id}}/{{$dp->portfolio->slug}}/{{$photo->name}}"
                        alt=" Card image cap">
                    @endforeach
                </div>
                @else
                <div class="col-4 align-self-center">
                    <h6 class="text-center al-grey-color al-font1 font-weight-bold">
                        @switch($dp->pfType_id)
                        @case('W')
                        Wedding
                        @break
                        @case('preW')
                        Pre-Wedding
                        @break
                        @case('S')
                        Siraman/Pengajian
                        @break
                        @case('L')
                        Lamaran
                        @break
                        @default
                        Data not found.
                        @endswitch
                    </h6>
                    <h3 class="py-2 text-center al-font-portfolio-name al-grey-color">{{$dp->portfolio->name}}</h3>
                    <h6 class="text-center al-grey-color al-font1 font-weight-bold">
                        {{date("d . m . Y", strtotime($dp->portfolio->date))}}
                        | Jakarta Barat
                    </h6>
                </div>
                @endif
            </div>
        </a>
        @endif
        @endforeach
    </div>

    {{-- 
    @if (!empty($promo))
    <div class="al-dp py-4 text-center">
        <div class="row align-items-center">
            <div class="col-2">
                <div class="col d-flex">

                </div>
            </div>
            <div class="col-8">
                <h1 class="al-grey-color al-dp-title">Promo</h1>
            </div>
            <div class="col-2">
                <div class="col d-flex flex-row-reverse">

                </div>
            </div>
        </div>
    </div>
    @endif --}}

    @if ($displayed_feedbacks->count() > 0)
    <div class="al-feedback al-dp my-5 py-4 text-center">
        <div id="feedback-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <h1 class="al-dp-title">Testimoni</h1>
                @foreach ($displayed_feedbacks as $index => $displayed_feedback)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ $displayed_feedback->photo_path }}" alt="Avatar" class="al-img-circle my-3">
                    <h5 class="font-italic col-6 m-auto">
                        {{ $displayed_feedback->feedback->kesan_pesan}}
                    </h5>
                    <h5 class="font-italic col-6 m-auto">
                        {{ $displayed_feedback->feedback->kritik_saran}}
                    </h5>
                    <h4 class="pt-4">
                        - {{ $displayed_feedback->feedback->mempelai_wanita }} &
                        {{ $displayed_feedback->feedback->mempelai_pria }} -
                    </h4>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#feedback-carousel" role="button" data-slide="prev">
                <button class="al-arrow-left"></button>
            </a>
            <a class="carousel-control-next" href="#feedback-carousel" role="button" data-slide="next">
                <button class="al-arrow-right"></button>
            </a>
        </div>
    </div>
    @endif

</div>
@endsection