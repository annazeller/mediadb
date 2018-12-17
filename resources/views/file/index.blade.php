@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row no-gutters">
            <div class="col-8">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div><br />
                @endif
                <table class="table">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Bearbeiten</th>
                        <th scope="col">Löschen</th>
                    </tr>
                    @foreach($files as $file)
                        <tr>
                            <th scope="col">{{$file->id}}</th>
                            <td>{{$file->name}}</td>
                            <td><a href="{{ route('file.edit',$file->id)}}" class="btn btn-secondary">Bearbeiten</a></td>
                            <td>
                                <form action="{{ route('file.destroy', $file->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Löschen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-4">
                Dateiinfo
            </div>
            <div class="col-12">
                <a href="{{ route('file.create')}}" class="btn btn-primary">Neuen Eintrag hinzufügen</a>
            </div>
        </div>
    </div>
@endsection
