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

<!-- Search form -->


<!-- Albums section -->
<section class="mt-5 bg-light text-center">
    <div class="row mx-auto mt-5">
        <div class="row">
            
            <div class="d-flex justify-content-center mb-5">
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
            </div>
            @foreach ($fotos as $foto)
            <div class="col-4 my-2">
                <div class="image-container">
                    <img src="{{ asset($foto->file_location) }}" class="card-img-top img-fluid"
                        alt="{{ $foto->file_location }}">
                    <div class="overlay d-flex flex-column justify-content-between p-2">
                        <h4 class="text-white mx-2">{{ $foto->title }}</h4>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="like d-flex align-items-center gap-2">
                                @php
                                    $userLiked = false;
                                    foreach ($foto->likeFoto as $like) {
                                        if ($like->user_id == Auth::user()->id) {
                                            $userLiked = true;
                                            break;
                                        }
                                    }
                                @endphp
                                @if ($userLiked)
                                    <form action="{{ route('like.remove', $like->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-light btn-hover" type="submit">
                                            <i class="bi bi-hand-thumbs-up-fill"></i> Unlike
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('like.add', $foto->id) }}" method="post">
                                        @csrf
                                        <button class="btn btn-outline-light btn-hover" type="submit">
                                            <i class="bi bi-hand-thumbs-up"></i> Like
                                        </button>
                                    </form>
                                @endif
                                <span class="text-white">{{ count($foto->likeFoto) }}</span>
                            </div>
                            <div class="komen">
                                <button type="button" class="btn btn-outline-light btn-hover" data-bs-toggle="modal"
                                    data-bs-target="#comment{{ $foto->id }}">({{ count($foto->komentarFoto) }})
                                    Komentar</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="comment{{ $foto->id }}" tabindex="-1"
                        aria-labelledby="comment{{ $foto->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-body row">
                                    <div class="col-8 p-0 m-0">
                                        <img src="{{ asset($foto->file_location) }}" class="card-img-top"
                                            alt="...">
                                    </div>
                                    <div class="col-4 card">
                                        <div class="border-bottom">
                                            <h1 class="modal-title fs-5 text-black"
                                                id="comment{{ $foto->id }}Label">{{ $foto->title }}</h1>
                                            <p>
                                                {{ $foto->description }}
                                            </p>
                                        </div>
                                        <div class="p-1 overflow-auto" style="max-height: 300px; height: 100%;">
                                            @if (count($foto->komentarFoto) == 0)
                                                <span class="text-center">Tidak ada Komentar</span>
                                            @endif

                                            @foreach ($foto->komentarFoto as $komentar)
                                                <div class="d-flex flex-column mb-3 position-relative">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <div>
                                                            <p class="text-wrap text-break mb-0">
                                                                <span
                                                                    class="fw-bold">{{ $komentar->user->username }}</span>
                                                                {{ $komentar->comment }}
                                                            </p>
                                                        </div>
                                                        @if ($komentar->user_id == Auth::user()->id)
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle no-arrow"
                                                                    type="button"
                                                                    id="dropdownMenuButton-{{ $komentar->id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="bi bi-three-dots"></i>
                                                                </button>
                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton-{{ $komentar->id }}">
                                                                    <li>
                                                                        <form
                                                                            class="dropdown-item d-flex align-items-center"
                                                                            action="{{ route('comment.remove', $komentar->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btn" type="submit">
                                                                                <i class="bi bi-trash"></i> Delete
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button"
                                                                            class="dropdown-item d-flex align-items-center"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#edit{{ $komentar->id }}">
                                                                            <i class="bi bi-pencil-fill"></i> Edit
                                                                        </button>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        @endif
                                                    </div>
                                                    <span
                                                        class="fs-7 text-start">{{ $komentar->created_at->diffForHumans() }}</span>
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="mt-auto">
                                            <div class="like d-flex align-items-center gap-2">
                                                @php
                                                    $userLiked = false;
                                                    foreach ($foto->likeFoto as $like) {
                                                        if ($like->user_id == Auth::user()->id) {
                                                            $userLiked = true;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                @if ($userLiked)
                                                    <form action="{{ route('like.remove', $like->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-dark btn-hover" type="submit">
                                                            <i class="bi bi-hand-thumbs-up-fill"></i> Unlike
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('like.add', $foto->id) }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-outline-dark btn-hover" type="submit">
                                                            <i class="bi bi-hand-thumbs-up"></i> Like
                                                        </button>
                                                    </form>
                                                @endif
                                                <span class="text-black">{{ count($foto->likeFoto) }}</span>
                                            </div>
                                            <form action="{{ route('comment.add', $foto->id) }}" method="post"
                                                class="d-flex gap-2" style="width: 100%">
                                                @csrf
                                                <input type="text" placeholder="Komentar..." name="comment"
                                                    id="" class="form-control">
                                                <button class="btn btn-outline-dark btn-hover"
                                                    type="submit">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal for Comments -->
            @foreach ($foto->komentarFoto as $komentar)
                <div class="modal fade" id="edit{{ $komentar->id }}" tabindex="-1"
                    aria-labelledby="edit{{ $komentar->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border rounded">
                            <form action="{{ route('comment.update', $komentar->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit{{ $komentar->id }}Label">Edit Komentar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Komentar</label>
                                        <input type="text" class="form-control" id="comment" name="comment"
                                            value="{{ $komentar->comment }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
      </div>
</section>
@endsection
