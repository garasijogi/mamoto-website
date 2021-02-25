@extends('adminlte::page')

@section('title', 'Kelola Portfolio')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@include('layouts.css.al-styles')

@section('content_header')
<h1 class="px-4 mt-2">Kelola Portfolio</h1>
@endsection

@section('content')
<div class="px-4">
  <a href="{{route('admin.portfolio.create')}}" class="btn btn-primary mb-3">Tambah Portfolio</a>
  <div class="card text-center">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item"><a class="nav-link active text-secondary" data-toggle="tab" href="#w">Wedding</a></li>
        <li class="nav-item"><a class="nav-link text-secondary" data-toggle="tab" href="#prew">Pre-Wedding</a></li>
        <li class="nav-item"><a class="nav-link text-secondary" data-toggle="tab" href="#s">Siraman/Pengajian</a></li>
        <li class="nav-item"><a class="nav-link text-secondary" data-toggle="tab" href="#l">Lamaran</a></li>
      </ul>
    </div>
    {{-- wedding tab --}}
    <div class="card-body tab-content">
      <div id="w" class="tab-pane active">
        <h3>Wedding</h3>
        <div class="row">
          @forelse ($portfolios['w'] as $p)
          <div class="col-4">
            <a href="{{route('admin.portfolio.show', $p->slug)}}" class="al-portfolio-link">
              <div class="card p-2 al-portfolio-card" style="width: 18rem;">
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
                  <div class="col-6 mb-2">
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
                <div class="card-body py-0 px-1">
                  <h6 class="text-center">
                    {{mb_strimwidth(ucfirst($p->name), 0, 30, "...")}}
                  </h6>
                  <small class="text-left text-secondary">{{date("d-m-Y", strtotime($p->date))}}</small>
                </div>
              </div>
            </a>
          </div>
          @empty
          <div class="col">
            <p>Tidak ada portfolio.</p>
          </div>
          @endforelse
        </div>
      </div>
      {{-- prewedding tab --}}
      <div id="prew" class="tab-pane fade">
        <h3>Pre-Wedding</h3>
        <div class="row">
          @forelse ($portfolios['prew'] as $p)
          <div class="col-4">
            <a href="{{route('admin.portfolio.show', $p->slug)}}" class="al-portfolio-link">
              <div class="card p-2 al-portfolio-card" style="width: 18rem;">
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
                  <div class="col-6 mb-2">
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
                <div class="card-body py-0 px-1">
                  <h6 class="text-center">
                    {{mb_strimwidth(ucfirst($p->name), 0, 30, "...")}}
                  </h6>
                  <small class="text-left text-secondary">{{date("d-m-Y", strtotime($p->date))}}</small>
                </div>
              </div>
            </a>
          </div>
          @empty
          <div class="col">
            <p>Tidak ada portfolio.</p>
          </div>
          @endforelse
        </div>
      </div>
      {{-- siraman/pengajian tab --}}
      <div id="s" class="tab-pane fade">
        <h3>Siraman/Pengajian</h3>
        <div class="row">
          @forelse ($portfolios['s'] as $p)
          <div class="col-4">
            <a href="{{route('admin.portfolio.show', $p->slug)}}" class="al-portfolio-link">
              <div class="card p-2 al-portfolio-card" style="width: 18rem;">
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
                  <div class="col-6 mb-2">
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
                <div class="card-body py-0 px-1">
                  <h6 class="text-center">
                    {{mb_strimwidth(ucfirst($p->name), 0, 30, "...")}}
                  </h6>
                  <small class="text-left text-secondary">{{date("d-m-Y", strtotime($p->date))}}</small>
                </div>
              </div>
            </a>
          </div>
          @empty
          <div class="col">
            <p>Tidak ada portfolio.</p>
          </div>
          @endforelse
        </div>
      </div>
      <div id="l" class="tab-pane fade">
        <h3>Lamaran</h3>
        {{-- lamaran tab --}}
        <div class="row">
          @forelse ($portfolios['l'] as $p)
          <div class="col-4">
            <a href="{{route('admin.portfolio.show', $p->slug)}}" class="al-portfolio-link">
              <div class="card p-2 al-portfolio-card" style="width: 18rem;">
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
                  <div class="col-6 mb-2">
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
                <div class="card-body py-0 px-1">
                  <h6 class="text-center">
                    {{mb_strimwidth(ucfirst($p->name), 0, 30, "...")}}
                  </h6>
                  <small class="text-left text-secondary">{{date("d-m-Y", strtotime($p->date))}}</small>
                </div>
              </div>
            </a>
          </div>
          @empty
          <div class="col">
            <p>Tidak ada portfolio.</p>
          </div>
          @endforelse
        </div>
        {{-- end tab --}}
      </div>
    </div>
  </div>
</div>
@endsection