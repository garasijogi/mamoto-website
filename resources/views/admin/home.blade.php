@extends('adminlte::page')

@section('title', 'Kelola Home')

@section('content_header')
<h1 class="px-4 mt-2">Kelola Home</h1>
@endsection

@section('css')
@include('layouts.css.al-styles')
@endsection

@section('content')
<div class="px-4">
    {{-- kelola jumbotron --}}
    <div class="al-tab border-bottom mb-2">
        <h6 class="font-weight-bold">Jumbotron</h6>
    </div>
    <div class="row pb-4 justify-content-md-center">
        <div class="col-md-6 text-center">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach ($jumbotrons as $index => $jumbotron)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img class="d-block w-100" height="300px" style="object-fit: contain;"
                            src="{{ $jumbotron->path }}" alt="slide {{ $index+1 }}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-12 text-center p-2">
            <a href="{{ route('admin.jumbotron') }}" class="btn btn-sm btn-primary">
                Ganti Foto
            </a>
        </div>
    </div>

    {{-- kelola displayed portfolio --}}
    <div class="al-tab border-bottom mb-4">
        <h6 class="font-weight-bold">Portfolio yang ditampilkan</h6>
    </div>
    <div class="row pb-4">
        @foreach ($displayed_portfolios as $index => $dp)
        <div class="col-3">
            <div class="row">
                <div class="col-12 mb-2 text-center">
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
                </div>
                <div class="col-12">
                    @if (empty($dp->portfolio->photo))
                    <img width='250px' height='250px' style='object-fit:cover;' src="/images/no-image.png"
                        alt=" Card image cap">
                    @else
                    @foreach (array_slice(json_decode($dp->portfolio->photo), 0, 1) as $photo)
                    <img width='250px' height='250px' style='object-fit:cover;'
                        src="/storage/images/portfolio/{{$dp->pfType_id}}/{{$dp->portfolio->slug}}/{{$photo->name}}"
                        alt=" Card image cap">
                    @endforeach
                    @endif
                </div>
                <div class="col-12 text-center p-2">
                    <a href="/admin/displayed-portfolio/W" class="btn btn-sm btn-primary text-white">
                        Ganti Portfolio
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- kelola promo --}}
    <div class="al-tab border-bottom mb-2">
        <h6 class="font-weight-bold">Promo yang ditampilkan</h6>
    </div>
    <div class="row text-center">
        <div class="col-12">
            <img width='500px' height='250px' style='object-fit:cover;'
                src="https://i0.wp.com/www.theweddingvowsg.com/wp-content/uploads/2016/09/wedding-photographers-indonesia-Featured-photo-Bunn-Salarzon.jpg?resize=960%2C637&ssl=1"
                alt="Card image cap">
        </div>
        <div class="col-12 p-2">
            <h6>Promo Akhir Bulan serba 20%</h6>
        </div>
        <div class="col-12 pb-2">
            <button class="btn btn-sm btn-primary">
                Ganti Promo
            </button>
        </div>
    </div>

    {{-- kelola testimoni --}}
    <div class="al-tab border-bottom mb-4">
        <h6 class="font-weight-bold">Feedback yang ditampilkan</h6>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-11">
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Feedback</th>
                        <th class="text-center" scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($displayed_feedbacks as $index => $df)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            @if (!empty($df->feedback_id))
                            {{ $df->feedback->mempelai_pria . ' & ' . $df->feedback->mempelai_wanita }}
                            @else
                            Feedback belum dipilih.
                            @endif
                        </td>
                        <td>
                            @if (!empty($df->feedback_id))
                            Kesan Pesan: {{ $df->feedback->kesan_pesan}} <br>Kritik Saran:
                            {{ $df->feedback->kritik_saran }}
                            @else
                            -
                            @endif
                        </td>
                        <td class="text-center">
                            <button data-id="{{ $df->id }}" data-toggle="modal" data-target="#feedback-modal"
                                class="btn change-feedback btn-sm btn-primary">
                                Ganti
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
{{-- modal for select feedback --}}
<div class="modal fade" id="feedback-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Pilih feedback</h5>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Feedback</th>
                            <th class="text-center" scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $index => $fb)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                {{ $fb->mempelai_pria . ' & ' . $fb->mempelai_wanita }}
                            </td>
                            <td>
                                Kesan/Pesan: {{ $fb->kesan_pesan}} <br>Kritik/Saran: {{ $fb->kritik_saran }}
                            </td>
                            <td class="text-center">
                                <button data-toggle="modal" onclick="modalCustomerPhotoUpload()" data-id="{{ $fb->id }}"
                                    data-target="#uploadphoto-modal" class="btn btn-sm btn-primary dp-id">
                                    Pilih
                                </button>
                            </td>
                        </tr>
                        @empty
                        <h6>No Feedback data.</h6>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- modal for upload photo --}}
<div class="modal fade" id="uploadphoto-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Pilih Foto Customer</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="img-container">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8">
                                    <img id="image" src="" alt='Your image' width="250px" height="250px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input customer-photo" id="customer-photo">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    {{-- photo --}}
                    <form action="/admin/displayed-feedback/edit" method="post" class="mb-4"
                        enctype="multipart/form-data" id="formCustomerPhoto">
                        @method('patch')
                        @csrf
                        <input type="hidden" value="" id="inputCustomerFile" name="inputCustomerFile">
                        <input type="hidden" name="feedback_id" id="feedback_id" value="">
                        <input type="hidden" name="dp_id" id="dp_id" value="">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitForm('formCustomerPhoto')">Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- modal for crop photo --}}
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="img-container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                            <img id="image-cropped" src="" alt='Your image'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="crop_image()">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('layouts.js.al-scripts')
@endsection