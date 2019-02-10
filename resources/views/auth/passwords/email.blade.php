@extends('app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-6">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h2>Passwort vergessen</h2>
            <form method="POST" action="{{ route('password.email') }}">
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
                    <small id="emailHelp" class="form-text text-muted">Bitte gib die E-Mail-Adresse an, die du beim Registrieren verwendet hast.</small>
                </div>
                <button class="btn btn-primary" type="submit">
                    Link zu Passwort zurücksetzen zusenden
                </button>
            </form>
        </div>
    </div>
@endsection
