Objektname: {{ session("documenttitle") }} <br>
Priorität: {{ session("urgency") }}<br>
Kategorie: {{ session("category") }} <br>
Zusätzliche Kategorie: {{ session("subcategories") }} <br>
Keywords: {{ session("keywords") }} <br>
Spezielle Anleitung: {{ session("specialinstructions") }} <br>
Autor: {{ session("autor") }} <br>
Stadt: {{ session("city") }} <br>
Provinz-Staat: {{ session("state") }} <br>
Land: {{ session("country") }} <br>
Ursprüngliche Übertragungsreferenz: {{ session("otr") }} <br>
Quelle: {{ session("photosource") }} <br>
Copyright: {{ session("copyright") }} <br>
Bildunterschrift: {{ session("caption") }} <br>
Erstellungs-Datum: {{ session("creationdate") }} <br>
Erstellungs-Zeit: {{ session("creationtime") }} <br> <br>

<form class="form-horizontal" method="post" action="/post">
    <input name="imageSource" type="hidden" value="{{ session("status") }}">
    <input name="imageName" type="hidden" value="{{ session("imageName") }}">
    <div class="form-group">
        <label for="rec" class="col-lg-2 control-label">
           Objektname
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="object_name">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Priorität
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="priority">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Kategorie
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="category">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Unterkategorie
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="supplemental_category">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Keywords
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="keywords">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Spezielle Anleitung
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="special_instructions">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Erstellungs-Datum
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="created_date">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Erstellungs-Zeit
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="created_time">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Autor
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="creator">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Stadt
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="city">
        </div>
    </div>
    <div class="form-group">
    <label for="value" class="col-lg-2 control-label">
        Provinz-Staat
    </label>
    <div class="col-lg-10">
        <input type="text" class="form-control" name="province_state">
    </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Land
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="country">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Ursprüngliche Übertragungsreferenz
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="original_transmission_reference">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Quelle
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="source">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Copyrihgt
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="copyright_string">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Bildunterschrift
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="caption">
        </div>
    </div>
    <div class="form-group">
        <label for="value" class="col-lg-2 control-label">
            Bildunterschrift-Schreiber
        </label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="credit">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <button type="reset" class="btn btn-default">Cancel</button>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>