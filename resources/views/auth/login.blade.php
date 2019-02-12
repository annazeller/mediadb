@extends('landingpage')

@section('content')
    {{--@if(Auth::check())
        @include('header.search')
        @include('header.upload')
    @endif--}}
    <div id="page-layout">
        <div class="container-fluid">
            @if(Auth::check())
                @include('layouts.notification')
            @endif
            <div class="row justify-content-center">
                <div class="col-6">
                    <h2>Anmelden</h2>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="loginEmail">E-Mail-Adresse</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather="mail"></i></span>
                                </div>
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="loginEmail" type="email" aria-describedby="emailHelp" name="email" placeholder="E-Mail" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                {{ $errors->first('email') }}
                            </span>
                                @endif
                            </div>
                            <small id="emailHelp" class="form-text text-muted">Wir würden deine E-Mail-Adresse niemals an dritte weitergeben.</small>
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Passwort</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather="lock"></i></span>
                                </div>
                                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" aria-describedby="loginPasswordHelp" id="loginPassword" name="password" placeholder="Passwort" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                {{ $errors->first('password') }}
                            </span>
                                @endif
                            </div>
                            <small id="loginPasswordHelp" class="form-text text-muted">Teile dein Passwort niemals mit anderen!</small>
                        </div>
                        <div class="row m-0 justify-content-between align-items-center mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" {{ old('remember') ? 'checked' : '' }} id="loginRemember" class="custom-control-input"><label class="custom-control-label" for="loginRemember">Erinnere dich an mich</label>
                            </div>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Passwort vergessen?
                            </a>
                        </div>
                        <div class="row m-0 justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Anmelden</button>
                            <a class="btn btn-link" href="{{ route('register') }}">
                                Ich bin neu hier
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
