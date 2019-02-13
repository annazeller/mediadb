@extends('app')
@section('content')
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
                    <h1>{{ $file->name }}</h1>
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
                                <td>Exif Data</td>
                                <td>
                                    <pre>
                                        @foreach($exifValues as $values)
                                            {{ print_r($values) }}
                                            @if(is_array($values))
                                                @foreach($values as $value)
                                                    {{ print_r($value) }}
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </pre>
                                </td>
                            </tr>
                        @if($isJpg)
                            <tr>
                                <td>Objektname</td>
                                <td>{{ $documenttitle }}</td>
                                <td>
                                    <label for="object_name">Neuen Wert festlegen</label>
                                    <div class="position-relative">
                                        <input type="text" value="{{ $documenttitle }}" placeholder="Bitte Wert eintragen" name="object_name" id="object_name" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Kategorie</td>
                                <td>{{ $category }}</td>
                                <td>
                                    <label for="category">Neuen Wert festlegen</label>
                                    <div class="position-relative">
                                        <input type="text" value="{{ $category }}" placeholder="Bitte Wert eintragen" name="category" id="category" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Zusätzliche Kategorie</td>
                                <td>{{ $subcategories }}</td>
                                <td>
                                    <label for="supplemental_category">Neuen Wert festlegen</label>
                                    <div class="position-relative">
                                        <input type="text" value="{{ $subcategories }}" placeholder="Bitte Wert eintragen" name="supplemental_category" id="supplemental_category" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
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
                                                <div class="position-relative">
                                                    <input type="text" value="{{ $value }}" placeholder="Bitte Wert eintragen" name="keywords" id="keywords" class="inputToClear">
                                                    <div class="clearInput" @click="clearInput()">
                                                        <i data-feather="x"></i>
                                                    </div>
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
                                    <div class="position-relative">
                                        <input type="text" value="{{$autor}}" placeholder="Bitte Wert eintragen" name="creator" id="creator" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Stadt</td>
                                <td>{{$city}}</td>
                                <td>
                                    <label for="city">Neuen Wert festlegen</label>
                                    <div class="position-relative">
                                        <input type="text" value="{{$city}}" placeholder="Bitte Wert eintragen" name="city" id="city" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Land</td>
                                <td>{{$country}}</td>
                                <td>
                                    <label for="country">Neuen Wert festlegen</label>
                                    <div class="position-relative">
                                        <input type="text" value="{{$country}}" placeholder="Bitte Wert eintragen" name="country" id="country" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bildquelle</td>
                                <td>{{$photosource}}</td>
                                <td>
                                    <label for="source">Neuen Wert festlegen</label>
                                    <div class="position-relative">
                                        <input type="text" value="{{$photosource}}" placeholder="Bitte Wert eintragen" name="source" id="source" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Copyright</td>
                                <td>{{$copyright}}</td>
                                <td>
                                    <label for="copyright_string">Neuen Wert festlegen</label>
                                    <div class="position-relative">
                                        <input type="text" value="{{$copyright}}" placeholder="Bitte Wert eintragen" name="copyright_string" id="copyright_string" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bildunterschrift</td>
                                <td>{{$caption}}</td>
                                <td>
                                    <label for="caption">Neuen Wert festlegen</label>
                                    <div class="position-relative">
                                        <input type="text" value="{{$caption}}" placeholder="Bitte Wert eintragen" name="caption" id="caption" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Erstellungs-Datum</td>
                                <td>{{$creationdate}}</td>
                                <td>
                                    <label for="created_date">Neuen Wert festlegen</label>
                                    <div class="position-relative">
                                        <input type="text" value="{{$creationdate}}" placeholder="Bitte Wert eintragen" name="created_date" id="created_date" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Erstellungs-Zeit</td>
                                <td>{{$creationtime}}</td>
                                <td>
                                    <label for="created_time">Neuen Wert festlegen</label>
                                    <div class="position-relative">
                                        <input type="text" value="{{$creationtime}}" placeholder="Bitte Wert eintragen" name="created_time" id="created_time" class="inputToClear">
                                        <div class="clearInput" @click="clearInput()">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                        @if($isJpg)
                        <div class="d-flex align-items-center mt-4 justify-content-between">
                            <button type="reset" class="btn btn-danger">Abbrechen</button>
                            <button type="submit" class="btn btn-primary">Speichern</button>
                        </div>
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection