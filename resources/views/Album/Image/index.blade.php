@extends('Layouts.dashboard')

@section('content')
    <div class="m-3">
        <div class="d-flex justify-content-between mb-3">
            <h4>Foto</h4>
            <a class="btn btn-primary" href="{{ route('foto.create', $albumId) }}">Create</a>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>Error:</b>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>success:</b>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row row-cols-12">
            @if (count($fotos) == 0)
                <h4 class="text-center">Tidak ada Foto</h4>
            @endif

            @foreach ($fotos as $foto)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm" style="width: 18rem;">
                        <div class="ratio ratio-16x9">
                            <img src="{{ asset($foto->file_location) }}" class="card-img-top img-fluid" alt="...">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $foto->title }}</h5>
                                    <p class="card-text">{{ $foto->description }}</p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle noarrow dropdown-btn" type="button"
                                        id="dropdownMenuButton-{{ $foto->id }}" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $foto->id }}">
                                        <li>
                                            <form class="dropdown-item" action="{{ route('foto.remove', $foto->id) }}"
                                                method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                                                @csrf @method('DELETE')
                                                <button class="btn" type="submit">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <div class="btn">
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $foto->id }}">
                                                    <i class="bi bi-pencil-fill"></i> Edit
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="like d-flex align-items-center">

                                @if (count($foto->likeFoto) > 0)
                                    @foreach ($foto->likeFoto as $like)
                                        @if ($like->user_id == Auth::user()->id)
                                            <form action="{{ route('like.remove', $like->id) }}" method="post">
                                                @csrf @method('DELETE')
                                                <button class="btn" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    @endforeach
                                @else
                                    <form action="{{ route('like.add', $foto->id) }}" method="post">
                                        @csrf
                                        <button class="btn" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149c.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                                <span class="m-3">{{ count($foto->likeFoto) }} Like</span>

                            </div>
                            <div class="komen">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#comment{{ $foto->id }}">({{ count($foto->komentarFoto) }})
                                    Komentar</button>
                                <div class="modal fade" id="comment{{ $foto->id }}" tabindex="-1"
                                    aria-labelledby="comment{{ $foto->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title text-center fs-5"
                                                    id="comment{{ $foto->id }}Label">
                                                    {{ $foto->title }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset($foto->file_location) }}" class="card-img-top"
                                                    alt="...">
                                                <div class="my-3">
                                                    <h4>Komentar</h4>
                                                    <div class="card p-3 overflow-auto" style="max-height: 180px">
                                                        @if (count($foto->komentarFoto) == 0)
                                                            <span class="text-center fw-bold">Tidak ada Komentar</span>
                                                        @endif


                                                        @foreach ($foto->komentarFoto as $komentar)
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1">
                                                                    <p class="fw-bold">{{ $komentar->user->username }}</p>
                                                                    @if ($komentar->user_id === Auth::id() || Auth::user()->role === 'admin')
                                                                        <form
                                                                            action="{{ route('comment.update', $komentar->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="form-group position-relative">
                                                                                <textarea class="form-control" id="comment{{ $komentar->id }}" name="comment" rows="3">{{ $komentar->comment }}</textarea>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary position-absolute top-50 translate-middleY end-0">Save</button>
                                                                            </div>
                                                                        </form>
                                                                    @else
                                                                        <p>{{ $komentar->comment }}</p>
                                                                    @endif
                                                                </div>
                                                                @if ($komentar->user_id === Auth::id() || Auth::user()->role === 'admin')
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn dropdown-toggle noarrow dropdown-btn"
                                                                            type="button"
                                                                            id="dropdownMenuButton-{{ $komentar->id }}"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="bi bi-three-dots-vertical"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu"
                                                                            aria-labelledby="dropdownMenuButton-{{ $komentar->id }}">
                                                                            <li>
                                                                                <form class="dropdown-item"
                                                                                    action="{{ route('comment.remove', $komentar->id) }}"
                                                                                    method="POST">
                                                                                    @csrf @method('DELETE')
                                                                                    <button class="btn" type="submit">
                                                                                        <i class="bi bi-trash"></i> Delete
                                                                                    </button>
                                                                                </form>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('comment.add', $foto->id) }}" method="post"
                                                    class="d-flex gap-2" style="width: 100%">
                                                    @csrf
                                                    <input type="text" placeholder="Komentar..." name="comment"
                                                        id="" class="form-control">
                                                    <button class="btn btn-primary" type="submit">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="modal fade" id="edit{{ $foto->id }}" tabindex="-1"
                    aria-labelledby="edit{{ $foto->id }}Label" aria-hidden="true">
                    <form class="modal-dialog modal-xl modal-dialog-centered"
                        action="{{ route('foto.update', $foto->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="edit{{ $foto->id }}Label">Edit foto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Edit</h4>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama foto</label>
                                    <input value="{{ $foto->title }}" type="text" name="title"
                                        class="form-control" placeholder="Nama Foto" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="description" id="" cols="20" rows="5">{{ $foto->description }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
