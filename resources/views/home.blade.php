@extends('layouts.app')
@section('title', 'Mamoto Picture - Home')
@section('content')
<div class="al-home-jumbotron al-full-content">
    <div class="al-jumbotron-carousel al-container" data-now="1" data-jumbotron1="{{ $jumbotrons[0]->path }}"
        data-jumbotron2="{{ $jumbotrons[1]->path }}" data-jumbotron3="{{ $jumbotrons[2]->path }}"
        data-jumbotron4="{{ $jumbotrons[3]->path }}">
        <div class="row align-items-center">
            <div class="col d-flex">
                <a href="#" class="al-arrow-left" onclick="changeJumbotron('previous')">
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
                <a href="#" id="1" class="al-arrow-right" onclick="changeJumbotron('next')"></a>
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

    <div class="al-feedback al-dp my-5 py-5 text-center">
        <h1>Testimoni</h1>
        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="al-img-circle my-3">
        <h5 class="font-italic col-6 m-auto">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum non magni asperiores error neque quas sint?
            Alias aliquid repellat non sed nisi, illum ab nesciunt similique neque sunt eligendi voluptatem hic
            molestias, ut rem dicta sint esse officiis assumenda expedita excepturi ipsa. Itaque mollitia odit
            possimus
            accusamus corrupti excepturi sequi quos molestias deleniti ipsa, amet dolorem cumque, suscipit
            praesentium
            repellat vel alias animi quasi nihil deserunt doloremque veniam repellendus qui. Commodi autem quos,
            porro
            repudiandae consequuntur quibusdam atque, eveniet quaerat modi, aut ut perferendis reprehenderit dolorem
            dicta recusandae at vero veniam animi. Omnis aliquid magni cum, quia sint quisquam facere.
        </h5>
        <h4 class="pt-4">
            - Azam & Nissa -
        </h4>
    </div>

</div>
@endsection