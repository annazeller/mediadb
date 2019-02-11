@extends('app')
@section('content')
    <div class="row mb-4">
        <div class="col-6">
            <img src="https://picsum.photos/800/450/?random" class="detailed-image img-fluid">
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
                <input name="imageSource" type="hidden" value="{{ session("status") }}">
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
                        <td>Objektname</td>
                        <td>
                            @if (session("documenttitle"))
                                {{ session("documenttitle") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="object_name">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("documenttitle") }}" placeholder="Bitte Wert eintragen" name="object_name" id="object_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Priorität</td>
                        <td>
                            @if (session("urgency"))
                                {{ session("urgency") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="priority">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("urgency") }}" placeholder="Bitte Wert eintragen" name="priority" id="priority">
                        </td>
                    </tr>
                    <tr>
                        <td>Kategorie</td>
                        <td>
                            @if (session("category"))
                                {{ session("category") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="category">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("category") }}" placeholder="Bitte Wert eintragen" name="category" id="category">
                        </td>
                    </tr>
                    <tr>
                        <td>Zusätzliche Kategorie</td>
                        <td>
                            @if (session("subcategories"))
                                {{ session("subcategories") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="supplemental_category">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("subcategories") }}" placeholder="Bitte Wert eintragen" name="supplemental_category" id="supplemental_category">
                        </td>
                    </tr>
                    <tr>
                        <td>Keywords</td>
                        <td>
                            @if (session("keywords"))
                                {{ session("keywords") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="keywords">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("keywords") }}" placeholder="Bitte Wert eintragen" name="keywords" id="keywords">
                        </td>
                    </tr>
                    <tr>
                        <td>Spezielle Anleitung</td>
                        <td>
                            @if (session("specialinstructions"))
                                {{ session("specialinstructions") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="special_instructions">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("specialinstructions") }}" placeholder="Bitte Wert eintragen" name="special_instructions" id="special_instructions">
                        </td>
                    </tr>
                    <tr>
                        <td>Autor</td>
                        <td>
                            @if (session("autor"))
                                {{ session("autor") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="creator">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("autor") }}" placeholder="Bitte Wert eintragen" name="creator" id="creator">
                        </td>
                    </tr>
                    <tr>
                        <td>Stadt</td>
                        <td>
                            @if (session("city"))
                                {{ session("city") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="city">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("city") }}" placeholder="Bitte Wert eintragen" name="city" id="city">
                        </td>
                    </tr>
                    <tr>
                        <td>Provinz/Staat</td>
                        <td>
                            @if(session("state"))
                                {{ session("state") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="province_state">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("state") }}" placeholder="Bitte Wert eintragen" name="province_state" id="province_state">
                        </td>
                    </tr>
                    <tr>
                        <td>Land</td>
                        <td>
                            @if (session("country"))
                                {{ session("country") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="country">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("country") }}" placeholder="Bitte Wert eintragen" name="country" id="country">
                        </td>
                    </tr>
                    <tr>
                        <td>Ursprüngliche Übertragungsreferenz</td>
                        <td>
                            @if (session("otr"))
                                {{ session("otr") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="original_transmission_reference">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("otr") }}" placeholder="Bitte Wert eintragen" name="original_transmission_reference" id="original_transmission_reference">
                        </td>
                    </tr>
                    <tr>
                        <td>Quelle</td>
                        <td>
                            @if (session("photosource"))
                                {{ session("photosource") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="source">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("photosource") }}" placeholder="Bitte Wert eintragen" name="source" id="source">
                        </td>
                    </tr>
                    <tr>
                        <td>Copyright</td>
                        <td>
                            @if (session("copyright"))
                                {{ session("copyright") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="copyright_string">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("copyright") }}" placeholder="Bitte Wert eintragen" name="copyright_string" id="copyright_string">
                        </td>
                    </tr>
                    <tr>
                        <td>Bildunterschrift</td>
                        <td>
                            @if (session("caption"))
                                {{ session("caption") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="caption">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("caption") }}" placeholder="Bitte Wert eintragen" name="caption" id="caption">
                        </td>
                    </tr>
                    <tr>
                        <td>Erstellungs-Datum</td>
                        <td>
                            @if (session("creationdate"))
                                {{ session("creationdate") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="created_date">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("creationdate") }}" placeholder="Bitte Wert eintragen" name="created_date" id="created_date">
                        </td>
                    </tr>
                    <tr>
                        <td>Erstellungs-Zeit</td>
                        <td>
                            @if (session("creationtime"))
                                {{ session("creationtime") }}
                            @else
                                <i>Kein Wert vorhanden</i>
                            @endif
                        </td>
                        <td>
                            <label for="created_time">Neuen Wert festlegen</label>
                            <input type="text" value="{{ session("creationtime") }}" placeholder="Bitte Wert eintragen" name="created_time" id="created_time">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="d-flex align-items-center mt-4 justify-content-between">
                    <button type="submit" class="btn btn-primary">Speichern</button>
                    <button type="reset" class="btn btn-danger">Abbrechen</button>
                </div>
            </form>
        </div>
    </div>
@endsection