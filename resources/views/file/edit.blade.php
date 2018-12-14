@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
    <form method="post" action="{{ route('file.update', $files->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Neuer Testname:</label>
            <input type="text" class="form-control" name="name" value={{ $files->name }} />
        </div>
        <button type="submit" class="btn btn-primary">Speichern</button>
    </form>
@endsection
