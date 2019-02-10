@extends('app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <h2 class="title">Passwort zurücksetzen</h2>
            <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" class="input" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="registerEmail">E-Mail-Adresse</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="mail"></i></span>
                        </div>
                        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="registerEmail" value="{{ $email or old('email') }}" aria-describedby="registerEmailHelp" type="email" name="email" placeholder="E-Mail-Adresse">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    <small id="registerEmailHelp" class="form-text text-muted">Bitte gib deine E-Mail-Adresse an.</small>
                </div>
                <div class="form-group">
                    <label for="registerPassword">Neues Passwort</label>
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
                    <label for="registerPassword">Neues Passwort bestätigen</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="lock"></i></span>
                        </div>
                        <input id="password-confirm" type="password" aria-describedby="registerPasswordConfirmHelp" class="form-control" name="password_confirmation" placeholder="Passwort bestätigen">
                    </div>
                    <small id="registerPasswordConfirmHelp" class="form-text text-muted">Bitte gebe dein Passwort nochmal ein.</small>
                </div>
                <button class="btn btn-primary" type="submit">
                    Passwort zurücksetzen
                </button>
            </form>
        </div>
    </div>

@endsection
