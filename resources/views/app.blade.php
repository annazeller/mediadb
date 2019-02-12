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
        Seite lädt...
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
            <div id="inner-content">
                @yield('content')

            </div>
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
        </div>
        @if(Auth::check())
            @include('layouts.confirm')
            @include('layouts.modal')
        @endif
    </div>

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
