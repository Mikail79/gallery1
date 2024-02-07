@extends('Layouts.landing')

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

@endsection
