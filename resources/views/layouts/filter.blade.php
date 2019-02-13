{{--<div class="filter-wrapper">
    <span id="filter-value">@{{ filterDefault }}</span>
    <input type="hidden" v-bind:value="filter">
    <ul id="filter" v-model="filter" name="filter">
        <li v-for="category in categories">@{{category.name}}</li>
    </ul>
</div>--}}
<div class="d-flex flex-column w-100">
    <label for="filter" class="d-inline-block" style="margin-bottom: 2px;">Filtern nach Kategorie</label>
    <select class="form-control boxLook"  id="filter" v-model="filter" name="filter">
        <option value="" selected>Bitte auswählen</option>
        <option v-for="category in categories" :value="category.name">Filtern nach: @{{category.name}}</option>
    </select>
</div>
