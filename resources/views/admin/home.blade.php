@extends('adminlte::page')

@section('title', 'Kelola Home')

@section('content_header')
<h1 class="px-4 mt-2">Kelola Home</h1>
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
                    <tr>
                        <td>1</td>
                        <td>Zizah & Arianto</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio inventore harum labore
                            dolorem asperiores modi? Totam fugiat nemo repellendus ad architecto laboriosam quia a,
                            expedita aliquam quibusdam earum, assumenda perferendis!</td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                Ganti
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ani & Aldi</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, odit.</td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                Ganti
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Rina & Gandhi</td>
                        <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione molestiae tenetur
                            provident beatae et, amet hic. Ducimus vel voluptas perferendis atque molestias dolore
                            nisi
                            placeat suscipit ab, ea tenetur laboriosam, animi itaque. Perspiciatis quidem doloribus
                            fugiat qui quas ad delectus nesciunt porro repellat debitis blanditiis optio tenetur
                            illum
                            corporis asperiores, eaque voluptas nemo sequi possimus accusantium sunt? Nisi incidunt
                            impedit magni numquam adipisci eveniet eum tempora sed autem odio aliquid debitis
                            molestiae,
                            recusandae molestias facilis? Blanditiis incidunt aliquid excepturi recusandae fugiat
                            beatae, adipisci, aspernatur saepe eaque quisquam nam? Eum, odit voluptatum. Id
                            eligendi,
                            nesciunt nostrum soluta doloribus voluptas sunt voluptatem!</td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                Ganti
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Nasya & Nizar</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, quo facilis earum rem
                            deserunt natus qui alias dolor reprehenderit repudiandae error placeat accusantium
                            voluptas
                            quis veniam, corporis quibusdam, consequuntur at laboriosam cumque autem obcaecati! Ex
                            quisquam corrupti quae iure unde voluptas neque cum atque, culpa cumque. Dolore pariatur
                            inventore omnis.</td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                Ganti
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection