{{--
<nav class="navbar navbar-expand-lg">
</nav>
--}}

<div class="search-wrapper container-fluid">
    <div class="row">
        <div class="col-4">
            <form class="navbar-form" role="search">
                <input class="search-input" v-model="keywords" placeholder="Suche" name="srch-term" id="srch-term" type="text">
                <button class="search-submit" type="submit"><i data-feather="search"></i></button>
            </form>
        </div>
        <div class="col-8">
            <div class="navbar-collapse" id="navbarNav">
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