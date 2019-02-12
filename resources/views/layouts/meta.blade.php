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
            <div class="row mb-4">
                <div class="col-6">
                    <img src="{{asset($filePath)}}" class="detailed-image img-fluid">
                </div>
                <div class="col-6">
                    <h1>Bildname</h1>
                    Bearbeitungsfunktionen blablabla
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2>IPTC/EXIF-Daten:</h2>
                    <form method="post" action="/post">
                        <input name="imageSource" type="hidden" value="{{ $path }}">
                        <input name="imageName" type="hidden" value="{{ $file->name }}">
                        <table id="exif-table" class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Wert</th>
                                <th scope="col">Funktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>exif</td>
                                <td>{{head($exif)}}</td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>Objektname</td>
                                <td>{{ $documenttitle }}</td>
                                <td>
                                    <label for="object_name">Neuen Wert festlegen</label>
                                    <input type="text" value="{{ $documenttitle }}" placeholder="Bitte Wert eintragen" name="object_name" id="object_name">
                                    <div class="clearInput" onclick="document.getElementById('object_name').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Kategorie</td>
                                <td>{{ $category }}</td>
                                <td>
                                    <label for="category">Neuen Wert festlegen</label>
                                    <input type="text" value="{{ $category }}" placeholder="Bitte Wert eintragen" name="category" id="category">
                                    <div class="clearInput" onclick="document.getElementById('category').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Zusätzliche Kategorie</td>
                                <td>{{ $subcategories }}</td>
                                <td>
                                    <label for="supplemental_category">Neuen Wert festlegen</label>
                                    <input type="text" value="{{ $subcategories }}" placeholder="Bitte Wert eintragen" name="supplemental_category" id="supplemental_category">
                                    <div class="clearInput" onclick="document.getElementById('supplemental_category').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Keywords</td>
                                <td>
                                    @if($keywords)
                                        @if(is_array($keywords))
                                            @foreach($keywords as $value)
                                                {{ $value }}
                                            @endforeach
                                        @endif
                                    @else
                                        Nicht vorhanden
                                @endif
                                <td>
                                    <label for="keywords">Neuen Wert festlegen</label>
                                    @if($keywords)
                                        @if(is_array($keywords))
                                            @foreach($keywords as $value)
                                                <input type="text" value="{{ $value }}" placeholder="Bitte Wert eintragen" name="keywords" id="keywords">
                                                <div class="clearInput" onclick="document.getElementById('keywords').value = ''">
                                                    <i data-feather="x"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                    @else
                                        <input type="text" value="" placeholder="Bitte Wert eintragen" name="keywords" id="keywords">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Autor</td>
                                <td>{{$autor}}</td>
                                <td>
                                    <label for="creator">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$autor}}" placeholder="Bitte Wert eintragen" name="creator" id="creator">
                                    <div class="clearInput" onclick="document.getElementById('creator').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Stadt</td>
                                <td>{{$city}}</td>
                                <td>
                                    <label for="city">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$city}}" placeholder="Bitte Wert eintragen" name="city" id="city">
                                    <div class="clearInput" onclick="document.getElementById('city').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Land</td>
                                <td>{{$country}}</td>
                                <td>
                                    <label for="country">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$country}}" placeholder="Bitte Wert eintragen" name="country" id="country">
                                    <div class="clearInput" onclick="document.getElementById('country').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bildquelle</td>
                                <td>{{$photosource}}</td>
                                <td>
                                    <label for="source">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$photosource}}" placeholder="Bitte Wert eintragen" name="source" id="source">
                                    <div class="clearInput" onclick="document.getElementById('source').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Copyright</td>
                                <td>{{$copyright}}</td>
                                <td>
                                    <label for="copyright_string">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$copyright}}" placeholder="Bitte Wert eintragen" name="copyright_string" id="copyright_string">
                                    <div class="clearInput" onclick="document.getElementById('copyright_string').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bildunterschrift</td>
                                <td>{{$caption}}</td>
                                <td>
                                    <label for="caption">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$caption}}" placeholder="Bitte Wert eintragen" name="caption" id="caption">
                                    <div class="clearInput" onclick="document.getElementById('caption').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Erstellungs-Datum</td>
                                <td>{{$creationdate}}</td>
                                <td>
                                    <label for="created_date">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$creationdate}}" placeholder="Bitte Wert eintragen" name="created_date" id="created_date">
                                    <div class="clearInput" onclick="document.getElementById('created_date').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Erstellungs-Zeit</td>
                                <td>{{$creationtime}}</td>
                                <td>
                                    <label for="created_time">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$creationtime}}" placeholder="Bitte Wert eintragen" name="created_time" id="created_time">
                                    <div class="clearInput" onclick="document.getElementById('created_time').value = ''">
                                        <i data-feather="x"></i>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="d-flex align-items-center mt-4 justify-content-between">
                            <button type="reset" class="btn btn-danger">Abbrechen</button>
                            <button type="submit" class="btn btn-primary">Speichern</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection