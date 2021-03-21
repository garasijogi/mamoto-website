@extends('layouts.app')
@section('title', 'Mamoto Picture - Home')
@section('content')
<div class="al-home-jumbotron al-full-content">
    <div class="al-jumbotron-carousel al-container" data-now="1" data-jumbotron1="{{ $jumbotrons[0]->path }}"
        data-jumbotron2="{{ $jumbotrons[1]->path }}" data-jumbotron3="{{ $jumbotrons[2]->path }}"
        data-jumbotron4="{{ $jumbotrons[3]->path }}">
        <div class="row align-items-center">
            <div class="col d-flex">
                <button class="al-arrow-left" onclick="changeJumbotron('previous')">
                    </a>
            </div>
            <div class="col-9 al-jumbotron">
                <div id='jumbotron'>
                    <div>
                        <h6 class="al-jumbotron-text">Let's talk about your moment</h6>
                    </div>
                </div>
            </div>
            <div class="col d-flex flex-row-reverse">
                <button class="al-arrow-right" onclick="changeJumbotron('next')"></a>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="al-displayed-portfolios">
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

    <div class="al-feedback al-dp my-5 py-4 text-center">
        <div class="row align-items-center">
            <div class="col-2">
                <div class="col d-flex">
                    <button class="al-arrow-left"
                        onclick="changeFeedback('previous', {{ count($displayed_feedbacks) }})">
                        </a>
                </div>
            </div>
            <div class="col-8">
                <h1>Testimoni</h1>
                @foreach ($displayed_feedbacks as $index => $df)
                <div class="{{ $index > 0 ? 'd-none '. $index : 'feedback-selected '. $index }}">
                    <img src="{{ $df->photo_path }}" alt="Avatar" class="al-img-circle my-3">
                    <h5 class="font-italic col-6 m-auto">
                        {{ $df->feedback->kesan_pesan}}
                    </h5>
                    <h5 class="font-italic col-6 m-auto">
                        {{ $df->feedback->kritik_saran}}
                    </h5>
                    <h4 class="pt-4">
                        - {{ $df->feedback->mempelai_wanita }} & {{ $df->feedback->mempelai_pria }} -
                    </h4>
                </div>
                @endforeach
            </div>
            <div class="col-2">
                <div class="col d-flex flex-row-reverse">
                    <button class="al-arrow-right"
                        onclick="changeFeedback('next', {{ count($displayed_feedbacks) }})"></a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection