<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Judul Default')</title>
    <link rel="icon" href="/img/tirta.png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- <link rel="stylesheet" href="sweetalert2.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header>
            <!-- <nav class="navbar bg-primary">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">
                        <img src="/img/tirta.png" alt="icon" style="max-width:50px;" class="ms-5">
                    </span>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto text-light">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
        </nav> -->
        <nav class="navbar navbar-expand-lg bg-secondary-subtle">
        <div class="container-fluid">
            <a href="/">
                <img src="/img/logo-perumda-tr.png" alt="icon" style="max-width:100px;" class="ms-5">
            </a>
            @if(Auth::check())
            <span class="nav-link text-dark ms-auto me-2">{{ Auth::user()->username }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                <button type="submit" onclick="return confirm('Ente Yakin Mau Keluar Aplikasi?')" class="nav-link btn btn-link text-light bg-danger p-2" style="text-decoration: none;">Logout</button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                </form>
                    @else
                        <a class="nav-link active text-dark" aria-current="page" href="/login">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    </header>

    <main>
        @yield('content')
    </main>

    <footer class="text-center relative-bottom">
        <div class="container p-4"></div>
        <div class="text-center text-black p-3 bg-secondary">
            © 2024
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
      defer
    ></script>
</body>
</html>
