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
<body class="not-loaded" id="dashboard">
    <div id="loader">
        Seite Lädt...
    </div>
    <div id="app">
        <div id="sidebar">
            <a href="/" id="logo">
                MediaDB
            </a>
            <ul>
                <li :class="{'active': isActive('image')}" @click="getFiles('image')">
                    <img src="{{ asset('images/image.svg') }}">
                    <img class="blue" src="{{ asset('images/image-blue.svg') }}">
                    Bilder
                </li>
                <li :class="{'active': isActive('audio')}" @click="getFiles('audio')">
                    <img src="{{ asset('images/music.svg') }}">
                    <img class="blue" src="{{ asset('images/music-blue.svg') }}">
                    Musik
                </li>
                <li :class="{'active': isActive('video')}" @click="getFiles('video')">
                    <img src="{{ asset('images/video.svg') }}">
                    <img class="blue" src="{{ asset('images/video-blue.svg') }}">
                    Videos
                </li>
                <li :class="{'active': isActive('document')}" @click="getFiles('document')">
                    <img class="width" src="{{ asset('images/document.svg') }}">
                    <img class="width blue" src="{{ asset('images/document-blue.svg') }}">
                    Dokumente
                </li>
            </ul>
        </div>
        <div id="content">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid p-0">
                    <div class="row w-100 no-gutters">
                        <div class="col-6">
                            <form class="navbar-form" role="search">
                                <input class="search-input" v-model="keywords" placeholder="Suche" name="srch-term" id="srch-term" type="text">
                                <button class="search-submit" type="submit"><i data-feather="search"></i></button>
                            </form>
                        </div>
                        <div class="col-6">
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
                                                <i data-feather="user"></i>
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
                    </div>
                </div>
            </nav>
            <div class="sub-navbar">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
                        <div class="col-4">
                            <div class="filter-bar">
                                <div class="filter-button">
                                    Option 1
                                </div>
                                <div class="filter-button">
                                    Option 2
                                </div>
                                <div class="filter-button">
                                    Option 3
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="search-items">
                                @if(Auth::check())
                                    @include('layouts.file-form')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id="page-layout">
                <div class="container-fluid">
                    @if(Auth::check())
                        @include('layouts.notification')
                        @include('layouts.confirm')
                        @include('layouts.modal')
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark navbar-dark text-light">
        <div class="container-fluid h-100">
            <div class="row h-100 align-items-center justify-content-between">
                <div class="col-12">
                    <p class="m-0">Test</p>
                </div>
            </div>
        </div>
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
