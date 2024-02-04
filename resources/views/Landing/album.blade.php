@extends('Layouts.landing')

@section('content')
    <header class="masthead" style="background-image: url('{{ asset($album->foto[count($album->foto) - 1]->file_location) }}')">
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
                        <img src="{{ asset($foto->file_location) }}" class="card-img-top img-fluid" alt="{{ $foto->file_location }}">
                        <div class="overlay d-flex flex-column justify-content-between p-2">
                            <h4 class="text-white mx-2">{{ $foto->title }}</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="like d-flex align-items-center gap-2">
                                    @if (count($foto->likeFoto) > 0)
                                    @foreach ($foto->likeFoto as $like)
                                    @if ($like->user_id == Auth::user()->id)
                                    <form action="{{ route('like.remove', $like->id) }}" method="post">
                                      @csrf
                                              @method('DELETE')
                                              <button class="btn btn-outline-light btn-hover" type="submit">
                                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                              </button>
                                            </form>
                                            @endif
                                        @endforeach
                                      @else
                                      <form action="{{ route('like.add', $foto->id) }}" method="post">
                                        @csrf
                                        <button class="btn btn-outline-light btn-hover" type="submit">
                                            <i class="bi bi-hand-thumbs-up"></i>
                                        </button>
                                      </form>
                                      @endif
                                      <span class="text-white">{{ count($foto->likeFoto)}}</span>
                                </div>
                                <div class="komen">
                                  <button type="button" class="btn btn-outline-light btn-hover" data-bs-toggle="modal" data-bs-target="#comment{{ $foto->id }}">({{ count($foto->komentarFoto)  }}) Komentar</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="comment{{ $foto->id }}" tabindex="-1" aria-labelledby="comment{{ $foto->id }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                              <div class="modal-content">
                                <div class="modal-body row">
                                    <div class="col-8 p-0 m-0">
                                        <img src="{{ asset($foto->file_location) }}" class="card-img-top" alt="...">
                                    </div>
                                    <div class="col-4 card">
                                        <div class="border-bottom">
                                            <h1 class="modal-title fs-5 text-black" id="comment{{ $foto->id }}Label">{{ $foto->title }}</h1>
                                            <p>
                                                {{ $foto->description }}
                                            </p>
                                        </div>
                                        <div class="p-1 overflow-auto" style=" max-height: 300px; height:100%">
                                            @if (count($foto->komentarFoto) == 0)
                                                <span class="text-center">Tidak ada Komentar</span>
                                            @endif

                                            @foreach ($foto->komentarFoto as $komentar)
                                                <div class="d-flex flex-column mb-3 position-relative">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <div>
                                                            <p class="text-wrap text-break mb-0">
                                                                <span class="fw-bold">{{ $komentar->user->username }}</span>
                                                                {{ $komentar->comment }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="fs-7">{{ Carbon\Carbon::parse($komentar->created_at)->diffForHumans() }}</span>
                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle no-arrow" type="button" id="dropdownMenuButton-{{ $komentar->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi bi-three-dots"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $komentar->id }}">
                                                                <li>
                                                                    <form class="dropdown-item" action="{{ route('comment.remove', $komentar->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn" type="submit">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="mt-auto">
                                            <div class="like border-top d-flex align-items-center gap-2">
                                                @if (count($foto->likeFoto) > 0)
                                                @foreach ($foto->likeFoto as $like)
                                                @if ($like->user_id == Auth::user()->id)
                                                <form action="{{ route('like.remove', $like->id) }}" method="post">
                                                  @csrf
                                                          @method('DELETE')
                                                          <button class="btn btn-hover" type="submit">
                                                            <i style="font-size: 20px" class="bi bi-hand-thumbs-up-fill"></i>
                                                          </button>
                                                        </form>
                                                        @endif
                                                    @endforeach
                                                  @else
                                                  <form action="{{ route('like.add', $foto->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-hover" type="submit">
                                                        <i style="font-size: 20px" class="bi bi-hand-thumbs-up"></i>
                                                    </button>
                                                  </form>
                                                  @endif
                                                  <span class="text-white">{{ count($foto->likeFoto)}}</span>
                                            </div>
                                            <form action="{{ route('comment.add', $foto->id) }}" method="post" class="d-flex gap-2" style="width: 100%">
                                                @csrf
                                                <input type="text" placeholder="Komentar..." name="comment" id="" class="form-control">
                                                <button class="btn btn-outline-dark btn-hover" type="submit">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                @endforeach
        </div>
            {{-- <h5 class="card-title">{{ $foto->title }}</h5> --}}
    </section>
@endsection
