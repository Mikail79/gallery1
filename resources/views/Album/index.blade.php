@extends('Layouts.dashboard')

@section('content')
<div class="m-3 ">
    <div class="d-flex justify-content-between mb-3">
        <h4>Album</h4>
        <a class="btn btn-primary" href="{{ route('album.create') }}">Create</a>
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
    <div class="d-flex flex-wrap gap-3 justify-content-center">
        @if (count($albums) === 0)
            <h4 class="text-center ">Tidak ada Album</h4>
        @endif

        @foreach ($albums as $album)
        {{-- <a href="/album/image/{{ $album->id }}" class="text-decoration-none"> --}}
            <div class="card shadow" style="width: 18rem;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center ratio ratio-16x9">
                        @if (count($album->foto) > 0)
                            <img class="mb-3 card-img-top img-fluid" src="{{ asset($album->foto[count($album->foto) - 1]->file_location) }}" alt="">
                        @else
                            <span class="">Tidak ada Foto</span>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between"><div class=""></div>
                        <h5 class="card-title">{{ $album->album_name }}</h5>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle no-arrow" type="button" id="dropdownMenuButton-{{ $album->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $album->id }}">
                                <li>
                                    <form class="dropdown-item" action="{{ route('album.remove', $album->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn" type="submit">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <div class="btn">
                                        <a href="/album/image/{{ $album->id }}" class="text-decoration-none btn">
                                            <i class="bi bi-pencil-fill"></i> Detail
                                        </a>
                                    </div>
                                    <div class="btn">
                                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit{{ $album->id }}">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                  <p class="card-text">{{ $album->description }}</p>
                </div>
              </div>
        {{-- </a> --}}

  <!-- Modal -->
  <div class="modal fade" id="edit{{ $album->id }}" tabindex="-1" aria-labelledby="edit{{ $album->id }}Label" aria-hidden="true">
    <form class="modal-dialog modal-xl modal-dialog-centered" action="{{ route('album.update', $album->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="edit{{ $album->id }}Label">Edit Album</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <h4>Edit</h4>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama Album</label>
                  <input value="{{ $album->album_name }}" type="text" name="album_name" class="form-control" placeholder="Nama Album" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 d-flex flex-column">
                  <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
                  <textarea value class="form-control" name="description" id="" cols="20" rows="5">{{ $album->description }}</textarea>
                </div>
              </form>
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
