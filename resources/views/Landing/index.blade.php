@extends('Layouts.landing')

@section('content')
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
<!-- Image Showcases-->
<section class="showcase">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{asset("assets/image/bg-showcase-1.jpg")}}')"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>Fully Responsive Design</h2>
                <p class="lead mb-0">When you use a theme created by Start Bootstrap, you know that the theme will look great on any device, whether it's a phone, tablet, or desktop the page will behave responsively!</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url('{{asset("assets/image/bg-showcase-1.jpg")}}')"></div>
            <div class="col-lg-6 my-auto showcase-text">
                <h2>Updated For Bootstrap 5</h2>
                <p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 5 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 5!</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{asset("assets/image/bg-showcase-1.jpg")}}')"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>Easy to Use & Customize</h2>
                <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
            </div>
        </div>
    </div>
</section>

@endsection
