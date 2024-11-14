<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Judul Default')</title>
    <link rel="icon" href="/img/tirta.png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
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
        <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a href="/">
                <img src="/img/logo-perumda-tr.png" alt="icon" style="max-width:100px;" class="ms-5">
            </a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    @if(Auth::check())
                        <!-- Jika user login, tampilkan nama user dan tombol logout -->
                        <span class="nav-link text-light">{{ Auth::user()->username }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-light bg-danger" style="text-decoration: none;">Logout</button>
                        </form>
                    @else
                        <!-- Jika user belum login, tampilkan tombol login -->
                        <a class="nav-link active text-light" aria-current="page" href="/login">Login</a>
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
        <div class="text-center p-3 bg-primary">
            © 2024
        </div>
    </footer>

    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
