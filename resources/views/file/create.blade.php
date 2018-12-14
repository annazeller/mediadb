@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Datei Hinzufügen
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif
                        <form method="post" action="{{ route('file.store') }}">
                            <div class="form-group">
                                @csrf
                                <label for="name">Testame:</label>
                                <input type="text" class="form-control" name="name"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Speichern</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
