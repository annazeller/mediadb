@extends('app')
@section('content')
    @if(Auth::check())
        @include('header.search')
        @include('header.upload')
    @endif
    <div id="page-layout">
        <div class="container-fluid">
            @if(Auth::check())
                @include('layouts.notification')
            @endif
            <div class="row justify-content-center">
                <div class="col-6">
                    <h2>Registrieren</h2>
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="registerName">Benutzername</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather="user"></i></span>
                                </div>
                                <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="registerName" aria-describedby="usernameHelp" type="name" name="name" value="{{ old('name') }}" placeholder="Benutzername">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                {{ $errors->first('name') }}
                            </span>
                                @endif
                            </div>
                            <small id="usernameHelp" class="form-text text-muted">Bitte gib deinen Namen an.</small>
                        </div>
                        <div class="form-group">
                            <label for="registerEmail">E-Mail-Adresse</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather="mail"></i></span>
                                </div>
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="registerEmail" aria-describedby="registerEmailHelp" type="email" name="email" value="{{ old('email') }}" placeholder="E-Mail-Adresse">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                {{ $errors->first('email') }}
                            </span>

                                @endif
                            </div>
                            <small id="registerEmailHelp" class="form-text text-muted">Bitte gib deine E-Mail-Adresse an.</small>
                        </div>
                        <div class="form-group">
                            <label for="registerPassword">Passwort</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather="lock"></i></span>
                                </div>
                                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" aria-describedby="registerPasswordHelp" id="registerPassword" type="password" name="password" placeholder="Passwort">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                {{ $errors->first('password') }}
                            </span>
                                @endif
                            </div>
                            <small id="registerPasswordHelp" class="form-text text-muted">Bitte wähle ein sicheres Passwort mit mindestens 6 Zeichen.</small>
                        </div>
                        <div class="form-group">
                            <label for="registerPassword">Passwort bestätigen</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather="lock"></i></span>
                                </div>
                                <input id="password-confirm" type="password" aria-describedby="registerPasswordConfirmHelp" class="form-control" name="password_confirmation" placeholder="Passwort bestätigen">
                            </div>
                            <small id="registerPasswordConfirmHelp" class="form-text text-muted">Bitte gebe dein Passwort nochmal ein.</small>
                        </div>
                        <div class="row m-0 justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Registrieren</button>
                            <a class="btn btn-link" href="{{ route('login') }}">
                                Ich habe bereits einen Account
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection