<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' }
    </script>

    <title>{{ config('app.name', 'MediaDB') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="landingpage">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <img class="ci" src="../images/logo.png" alt="DAM its cool">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Anmelden</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrieren</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="user"></i>&nbsp;
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Abmelden</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-Image">
            <div class="container" id="app">
                <div class="row">
                    <div class="col-6">
                        <h1>Digital Asset Management</h1>
                        <p>DAM-Systeme waren noch nie so einfach!<p>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    <section class="About">
      <div class="container">
        <div class="row">
          <div class="col-6 pr-3">
            <h2>Mehr Zeit fürs Wesentliche</h2>
            <p>
              MediaDB ist die intuitive Dateiverwaltung für Marketing-Teams, die endlich Struktur und Ordnung in ihr
              Medienarchiv bringen wollen. Mit MediaDB organisieren Nutzer ihre Mediendateien einfach stressfrei,
              greifen deutlich schneller auf ihren Medienpool zu und teilen Inhalte gezielt. Jeder weiß zu jeder Zeit,
              welche Medien für welche Zwecke genutzt werden dürfen. Teams arbeiten auch übergreifend besser zusammen: keine Flaschenhälse, keine Fehlerquellen.
            <p>
          </div>
          <div class="col-6">
            <img class="img-fluid preview-image" src="../images/asset.png" alt="DAM its cool">
          </div>
        </div>
      </div>
      <div class="logos">
      <img class="corporate" src="../images/logos.png" alt="DAM its cool">
    </div>
    </section>
    <footer class="bg-dark navbar-dark text-light d-flex align-items-center justify-content-between">
        <div>
            &copy; Copyright 2019 MediaDB. Alle Rechte vorbehalten.
        </div>
        <ul class="meta-nav">
            <li>
                <a href="#">
                    Impressum
                </a>
            </li>
            <li>
                <a href="#">
                    Datenschutz
                </a>
            </li>
        </ul>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
