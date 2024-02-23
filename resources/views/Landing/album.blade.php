{{-- @extends('Layouts.landing')

@section('content')
    <header class="masthead"
        style="background-image: url('{{ asset($album->foto[count($album->foto) - 1]->file_location) }}')">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center text-white">
                        <h1 class="mb-5">{{ $album->album_name }}</h1>
                        <h4 class="text-white"> Created by {{ $album->user->username }}!</h4>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="row mx-auto mt-5">
            @foreach ($album->foto as $foto)
                <div class="col-4 my-2">
                    <div class="image-container">
                        <a data-bs-toggle="modal" data-bs-target="#imageModal{{ $foto->id }}">
                            <img src="{{ asset($foto->file_location) }}" class="card-img-top img-fluid"
                                alt="{{ $foto->file_location }}">
                        </a>
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
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="imageModal{{ $foto->id }}" tabindex="-1"
                        aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-overlay">
                                    <img src="{{ asset($foto->file_location) }}" class="modal-img" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Komentar -->
                    <div class="modal fade" id="comment{{ $foto->id }}" tabindex="-1"
                        aria-labelledby="comment{{ $foto->id }}Label" aria-hidden="true">
                        <div
                            class="modal-dialog modal-dialog-centered modal-xl d-flex align-items-center justify-content-center">
                            <div class="modal-content">
                                <div class="modal-body row">
                                    <div class="col-8 p-0 m-0 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset($foto->file_location) }}" class="card-img-top img-fluid"
                                            style="max-height: 80vh; width: auto;" alt="...">
                                    </div>
                                    <div class="col-4 card d-flex flex-column justify-content-between">
                                        <div class="border-bottom">
                                            <h1 class="modal-title fs-5 text-black" id="comment{{ $foto->id }}Label">
                                                {{ $foto->title }}</h1>
                                            <p>{{ $foto->description }}</p>
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
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="fs-7">{{ Carbon\Carbon::parse($komentar->created_at)->diffForHumans() }}</span>
                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle noarrow dropdown-btn"
                                                                type="button" id="dropdownMenuButton-{{ $komentar->id }}"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton-{{ $komentar->id }}">
                                                                <li>
                                                                    <form class="dropdown-item"
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
                                                                    <div class="btn">
                                                                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit{{ $komentar->id }}">
                                                                            <i class="bi bi-pencil-fill"></i> Edit
                                                                        </button>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" tabindex="-1"
                                                    aria-labelledby="edit{{ $komentar->id }}Label" aria-hidden="true">
                                                    <form class="modal-dialog modal-xl modal-dialog-centered"
                                                        action="{{ route('comment.update', $komentar->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="edit{{ $foto->id }}Label">Edit foto</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4>Edit</h4>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputEmail1"
                                                                        class="form-label">Komentar</label>
                                                                    <input value="{{ $komentar->comment }}"
                                                                        type="text" name="comment"
                                                                        class="form-control" placeholder="Komentar"
                                                                        aria-describedby="emailHelp">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div>
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
                                                        <button class="btn btn-outline-grey btn-hover" type="submit">
                                                            <i class="bi bi-hand-thumbs-up-fill"></i> Unlike
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('like.add', $foto->id) }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-outline-grey btn-hover" type="submit">
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
            @endforeach
        </div>
    </section>
@endsection --}}

@extends('Layouts.landing')

@section('content')
    <header class="masthead"
        style="background-image: url('{{ asset($album->foto[count($album->foto) - 1]->file_location) }}')">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center text-white">
                        <h1 class="mb-5">{{ $album->album_name }}</h1>
                        <h4 class="text-white"> Created by {{ $album->user->username }}!</h4>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="container">
        <div class="row mx-auto mt-5">
            @foreach ($album->foto as $foto)
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
                                                @if (Auth::user()->role === 'admin')
                                                    <!--delete buttons for photos -->
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle noarrow" type="button"
                                                            id="dropdownMenuButton-{{ $foto->id }}"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots"></i>
                                                        </button>
                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton-{{ $foto->id }}">
                                                            <li>
                                                                <form class="dropdown-item"
                                                                    action="{{ route('foto.remove', $foto->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn" type="submit">
                                                                        <i class="bi bi-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                @endif
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
                                                            class="fs-7">{{ $komentar->created_at->diffForHumans() }}</span>
                                                            @if (Auth::user()->role === 'admin' || $komentar->user_id == Auth::id())
                                                            <div class="position-relative">
                                                                <div class="dropdown">
                                                                    <button class="btn dropdown-toggle noarrow" type="button" id="dropdownMenuButton-{{ $komentar->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="bi bi-three-dots"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton-{{ $komentar->id }}">
                                                                        <li>
                                                                            <form class="dropdown-item" action="{{ route('comment.remove', $komentar->id) }}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="btn" type="submit">
                                                                                    <i class="bi bi-trash"></i> Delete
                                                                                </button>
                                                                            </form>
                                                                        </li>
                                                                        <li>
                                                                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit{{ $komentar->id }}">
                                                                                <i class="bi bi-pencil-fill"></i> Edit
                                                                            </button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endif
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
