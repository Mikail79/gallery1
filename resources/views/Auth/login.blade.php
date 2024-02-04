@extends('Layouts.auth')

@section('auth')
<section class="">
    <div class="container p-4 mt-5">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <!-- Email input -->
              <h4 class="mt-3">Login</h4>

              <div class="form-outline mb-4">
                <input name="email" type="email" id="form3Example3" class="form-control form-control-md"
                  placeholder="Enter a valid email address" />
                <label class="form-label" for="form3Example3">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-3">
                <input name="password" type="password" id="form3Example4" class="form-control form-control-md"
                  placeholder="Enter password" />
                <label class="form-label" for="form3Example4">Password</label>
              </div>

              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-md"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="/register"
                    class="link-danger">Register</a></p>
              </div>

            </form>
          </div>
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
      </div>
    </div>
      <!-- Right -->
    </div>
  </section>
@endsection
