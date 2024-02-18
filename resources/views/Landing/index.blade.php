{{-- @extends('Layouts.landing')

@section('content')
@guest
<header class="masthead" style="background-image: url('{{ asset('assets/image/album.jpg') }}')">
 <div class=" position-relative">
 <div class=" justify-content-center
            <div class="-xl-6">
                <div class="text-center text-white">
                    <h1 class="mb-5">Ingin membuat Album? Register Sekarang!</h1>
                    <a href="/register" class="btn btn-secondary btn-lg">Register!</a>
                </div>
            </div>
        </div>
    </div>
</header>
@endguest

@auth
<header class="masthead" style="background-image: url('{{ asset('assets/image/album.jpg') }}')">
    <div class=" container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white">
                    <h1 class="mb-5">Welcome, {{ Auth::user()->name }}!</h1>
                </div>
            </div>
        </div>
    </div>
</header>
@endauth

<section class="features-icons bg-light text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form class="d-flex mb-5" action="{{ route('landing.search') }}" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search album or user" aria-label="Search" name="query">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
        <h2 class="mb-5">Album</h2>
        @foreach ($albums as $album)
            <div class="col-lg-3">
                <a href="{{ route('landing.album', $album->id) }}" class="text-decoration-none">
                    <div class="features-icons-item card mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="d-flex align-items-center justify-content-center ratio ratio-16x9">
                            @if (count($album->foto) > 0)
                                <img class="mb-3 card-img-top img-fluid" src="{{ asset($album->foto[count($album->foto) - 1]->file_location) }}" alt="">
                            @else
                                <span class="">Tidak ada Foto</span>
                            @endif
                        </div>
                        <div class="p-3">
                            <h3>{{ $album->album_name }}</h3>
                            <p> Created by {{ $album->user->username }}</p>
                        </div>

                    </div>
                </a>
            </div>
        @endforeach

        {{ $albums->links() }}
    </div>
</section>

@endsection --}}

{{-- @extends('Layouts.landing')

@section('content')
@guest
<header class="masthead" style="background-image: url('{{ asset('assets/image/album.jpg') }}')">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white">
                    <h1 class="mb-5">Ingin membuat Album? Register Sekarang!</h1>
                    <a href="/register" class="btn btn-secondary btn-lg">Register!</a>
                </div>
            </div>
        </div>
    </div>
</header>
@endguest

@auth
<header class="masthead" style="background-image: url('{{ asset('assets/image/album.jpg') }}')">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white">
                    <h1 class="mb-5">Welcome, {{ Auth::user()->name }}!</h1>
                </div>
            </div>
        </div>
    </div>
</header>
@endauth
<!-- Icons Grid-->
<section class="features-icons bg-light text-center">
    <div class="container">
        <div class="row">
            <h2 class="mb-5">Album</h2>
            @foreach ($albums as $album)
            <div class="col-lg-4">
                <a href="{{ route('landing.album', $album->id) }}" class="text-decoration-none">
                    <div class="features-icons-item card mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="d-flex align-items-center justify-content-center ratio ratio-16x9">
                            @if (count($album->foto) > 0)
                                <img class="mb-3 card-img-top img-fluid" src="{{ asset($album->foto[count($album->foto) - 1]->file_location) }}" alt="">
                            @else
                                <span class="">Tidak ada Foto</span>
                            @endif
                        </div>
                        <div class="p-3">
                            <h3>{{ $album->album_name }}</h3>
                            <p> Created by {{ $album->user->username }}</p>
                        </div>

                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection --}}

@extends('Layouts.landing')

@section('content')
@guest
<header class="masthead" style="background-image: url('{{ asset('assets/image/album.jpg') }}')">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-white">
                    <h1 class="mb-5">Ingin membuat Album? Register Sekarang!</h1>
                    <a href="/register" class="btn btn-secondary btn-lg">Register!</a>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="text-justify d-flex justify-content-end text-white">
                    <div>
                        <p class="mb-5 fw-bolder fst-italic">Selamat datang di Gallery Foto Pictorium, hadir untuk Anda oleh Mika Company. Platform kami menawarkan pengalaman yang menyenangkan bagi pengguna untuk menjelajahi dan memamerkan album foto mereka. Baik Anda seorang fotografer berpengalaman atau hanya ingin berbagi kenangan, platform kami menyediakan alat yang Anda butuhkan untuk membuat koleksi yang menakjubkan.</p>
                        <div class="d-flex">
                            <img class="w-50 border border-4 border-secondary rounded-pill"
                                src={{asset("assets/image/pictorium.png")}} alt="dfsf">
                            <img class="w-50 border border-4 border-secondary rounded-pill"
                                src={{asset("assets/image/mika.png")}} alt="dfsf">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endguest

@auth
<header class="masthead" style="background-image: url('{{ asset('assets/image/album.jpg') }}')">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white">
                    <h1 class="mb-5">Welcome, {{ Auth::user()->name }}!</h1>
                </div>
            </div>
        </div>
    </div>
</header>
@endauth

<!-- Search form -->


<!-- Albums section -->
<section class="mt-5 bg-light text-center">
    <div class="container">
        <div class="row">
            <form class="d-flex mb-3 align-items-start" action="{{ route('landing.index') }}" method="GET">
                <input class="form-control me-2 flex-grow-1" type="search" placeholder="Search album" aria-label="Search" name="query">
                <button class="btn btn-outline-success me-2" type="submit">Search</button>
                <a href="{{ route('landing.index') }}" class="btn btn-outline-secondary" type="button">Reset</a>
            </form>
            <style>
                .btn-custom {
                    font-size: 1.25rem;
                    padding: 10px 20px;
                    border-radius: 25px;
                    transition: all 0.3s ease;
                }
            
                .btn-custom:hover {
                    transform: translateY(-2px);
                }
            
                .btn-album {
                    background-color: #1B1A55;
                    color: #fff;
                    border: 2px solid #1B1A55;
                }
            
                .btn-foto {
                    background-color: #1F2544;
                    color: #fff;
                    border: 2px solid #1F2544;
                }
            </style>
            <div class="d-flex justify-content-center mb-5">
                <div class="d-flex">
                    <a class="btn btn-custom btn-album me-4" href="/">Album</a>
                    <a class="btn btn-custom btn-foto" href="/foto-landing">Foto</a>
                </div>
            </div>
            
            
            @foreach ($albums as $album)
            <div class="col-lg-4">
                <a href="{{ route('landing.album', $album->id) }}" class="text-decoration-none">
                    <div class="features-icons-item card mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="d-flex align-items-center justify-content-center ratio ratio-16x9">
                            @if (count($album->foto) > 0)
                                <img class="mb-3 card-img-top img-fluid" src="{{ asset($album->foto[count($album->foto) - 1]->file_location) }}" alt="">
                            @else
                                <span class="">Tidak ada Foto</span>
                            @endif
                        </div>
                        <div class="p-3">
                            <h3>{{ $album->album_name }}</h3>
                            <p> Created by {{ $album->user->username }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

