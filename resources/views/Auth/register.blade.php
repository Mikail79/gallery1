@extends('Layouts.auth')

@section('auth')
<section class="">
    <div class="container mt-5 p-3 shadow-md">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="{{ route('register') }}" method="POST">
            @csrf
            <h4 class="my-2">Register</h4>
            <!-- Email input -->
            <div class="form-outline mb-3">
                <input name="name" type="text" id="form3Example3" class="form-control form-control-md"
                  placeholder="Nama" />
                <label class="form-label" for="form3Example3">Nama</label>
              </div>

              <div class="form-outline mb-3">
                <input name="username" type="text" id="form3Example3" class="form-control form-control-md"
                  placeholder="Username" />
                <label class="form-label" for="form3Example3">Username</label>
              </div>

              <div class="form-outline mb-3">
                <input name="alamat" type="text" id="form3Example3" class="form-control form-control-md"
                  placeholder="Alamat" />
                <label class="form-label" for="form3Example3">Alamat</label>
              </div>

            <div class="form-outline mb-3">
              <input name="email" type="email" id="form3Example3" class="form-control form-control-md"
                placeholder="Enter a valid email address" />
              <label class="form-label" for="form3Example3">Email address</label>
            </div>

            <!-- Password input  -->
            <div class="form-outline mb-3">
              <input name="password" type="password" id="form3Example4" class="form-control form-control-md"
                placeholder="Enter password" />
              <label class="form-label" for="form3Example4">Password</label>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-md"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="/login"
                  class="link-danger">Login</a></p>
            </div>

          </form>
        </div>
      </div>
    </div>
      <!-- Right -->
    </div>
  </section>
@endsection
