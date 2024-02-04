@extends('Layouts.dashboard')

@section('content')
<div class="m-3 ">
    <form class="card p-5 m-4" action="{{ route('album.store') }}" method="POST">
        @csrf
        <h4>Create</h4>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nama Album</label>
          <input type="text" name="album_name" class="form-control" placeholder="Nama Album" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 d-flex flex-column">
          <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
          <textarea class="form-control" name="description" id="" cols="20" rows="5"></textarea>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection
