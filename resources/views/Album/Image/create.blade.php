@extends('Layouts.dashboard')

@section('content')
<div class="m-3 ">
    <form class="card p-5 m-4" action="{{ route('foto.store', $albumId) }}" method="POST" enctype="multipart/form-data">
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
        @csrf
        <h4>Create</h4>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Judul</label>
          <input type="text" name="title" class="form-control" placeholder="Nama Foto" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 d-flex flex-column">
          <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
          <textarea class="form-control" name="description" id="" cols="20" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Foto</label>
            <input type="file" name="image" class="form-control" placeholder="Foto" aria-describedby="emailHelp">
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection
