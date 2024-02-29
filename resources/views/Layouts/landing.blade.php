<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gallery</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"
        type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/landingStyle.css') }}">
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-light  static-top" style="background-color: #265073">
        <div class="container">
            <a href="/"> <img src={{asset("assets/image/pictorium2.png")}} class="navbar-brand" href="/" width="150" height="80"></img>

                <div class=""></a>
                    {{-- @if (Auth::check() && Auth::user()->role === 'admin')
    <!-- Tombol hanya akan terlihat jika pengguna terotentikasi dan memiliki peran admin -->
    <a href="{{ route('admin.index') }}" class="btn btn-primary">Halaman Admin</a>
@endif --}}
                <a class="btn btn-lg text-light" href="/album">Album</a>
                @if (Auth::check())
                    <a class="btn btn-lg text-light" href="/logout">{{ Auth::user()->username }}</a>
                @else
                    <a class="btn btn-lg text-light" href="/login">Login</a>
                @endif
            </div>

        </div>
    </nav>
    <div class="">
        @yield('content')
    </div>
    <!-- Footer-->
    <footer class="footer p-4 " style="background-color: #637A9F">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 h-100 text-center text--start my-auto text-white">
                    <p class="text-muted small mb-4 mb-lg-0">Copyright © 2024 PT MIKA COMPANY.</p>
                </div>
                <div class="col-lg-12 h-100 text-center mx-auto">
                    <img src={{asset("assets/image/mika2.png")}} alt="Company Logo"
                    width="150" height="70">
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://kit.fontawesome.com/b3e36d9cbe.js" crossorigin="anonymous"></script>
</body>

</html>
