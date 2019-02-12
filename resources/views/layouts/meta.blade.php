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
                                <td>

                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>Objektname</td>
                                <td>{{ $documenttitle }}</td>
                                <td>
                                    <label for="object_name">Neuen Wert festlegen</label>
                                    <input type="text" value="{{ $documenttitle }}" placeholder="Bitte Wert eintragen" name="object_name" id="object_name">
                                </td>
                            </tr>
                            <tr>
                                <td>Priorität</td>
                                <td>{{ $urgency }}</td>
                                <td>
                                    <label for="urgency">Neuen Wert festlegen</label>
                                    <input type="text" value="{{ $urgency }}" placeholder="Bitte Wert eintragen" name="urgency" id="urgency">
                                </td>
                            </tr>
                            <tr>
                                <td>Kategorie</td>
                                <td>{{ $category }}</td>
                                <td>
                                    <label for="category">Neuen Wert festlegen</label>
                                    <input type="text" value="{{ $category }}" placeholder="Bitte Wert eintragen" name="category" id="category">
                                </td>
                            </tr>
                            <tr>
                                <td>Zusätzliche Kategorie</td>
                                <td>{{ $subcategories }}</td>
                                <td>
                                    <label for="supplemental_category">Neuen Wert festlegen</label>
                                    <input type="text" value="{{ $subcategories }}" placeholder="Bitte Wert eintragen" name="supplemental_category" id="supplemental_category">
                                </td>
                            </tr>
                            <tr>
                                <td>Keywords</td>
                                <td>{{$keywords}}
                                <td>
                                    <label for="keywords">Neuen Wert festlegen</label>
                                    <input type="text" value="{{ $keywords }}" placeholder="Bitte Wert eintragen" name="keywords" id="keywords">
                                </td>
                            </tr>
                            <tr>
                                <td>Spezielle Anleitung</td>
                                <td>{{ $specialinstructions }}</td>
                                <td>
                                    <label for="special_instructions">Neuen Wert festlegen</label>
                                    <input type="text" value="{{ $specialinstructions }}" placeholder="Bitte Wert eintragen" name="special_instructions" id="special_instructions">
                                </td>
                            </tr>
                            <tr>
                                <td>Autor</td>
                                <td>{{$autor}}</td>
                                <td>
                                    <label for="creator">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$autor}}" placeholder="Bitte Wert eintragen" name="creator" id="creator">
                                </td>
                            </tr>
                            <tr>
                                <td>Stadt</td>
                                <td>{{$city}}</td>
                                <td>
                                    <label for="city">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$city}}" placeholder="Bitte Wert eintragen" name="city" id="city">
                                </td>
                            </tr>
                            <tr>
                                <td>Provinz/Staat</td>
                                <td>$state</td>
                                <td>
                                    <label for="province_state">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$state}}" placeholder="Bitte Wert eintragen" name="province_state" id="province_state">
                                </td>
                            </tr>
                            <tr>
                                <td>Land</td>
                                <td>{{$country}}</td>
                                <td>
                                    <label for="country">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$country}}" placeholder="Bitte Wert eintragen" name="country" id="country">
                                </td>
                            </tr>
                            <tr>
                                <td>Ursprüngliche Übertragungsreferenz</td>
                                <td>{{$otr}}</td>
                                <td>
                                    <label for="original_transmission_reference">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$otr}}" placeholder="Bitte Wert eintragen" name="original_transmission_reference" id="original_transmission_reference">
                                </td>
                            </tr>
                            <tr>
                                <td>Quelle</td>
                                <td>{{$photosource}}</td>
                                <td>
                                    <label for="source">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$photosource}}" placeholder="Bitte Wert eintragen" name="source" id="source">
                                </td>
                            </tr>
                            <tr>
                                <td>Copyright</td>
                                <td>{{$copyright}}</td>
                                <td>
                                    <label for="copyright_string">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$copyright}}" placeholder="Bitte Wert eintragen" name="copyright_string" id="copyright_string">
                                </td>
                            </tr>
                            <tr>
                                <td>Bildunterschrift</td>
                                <td>{{$caption}}</td>
                                <td>
                                    <label for="caption">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$caption}}" placeholder="Bitte Wert eintragen" name="caption" id="caption">
                                </td>
                            </tr>
                            <tr>
                                <td>Erstellungs-Datum</td>
                                <td>{{$creationdate}}</td>
                                <td>
                                    <label for="created_date">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$creationdate}}" placeholder="Bitte Wert eintragen" name="created_date" id="created_date">
                                </td>
                            </tr>
                            <tr>
                                <td>Erstellungs-Zeit</td>
                                <td>{{$creationtime}}</td>
                                <td>
                                    <label for="created_time">Neuen Wert festlegen</label>
                                    <input type="text" value="{{$creationtime}}" placeholder="Bitte Wert eintragen" name="created_time" id="created_time">
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