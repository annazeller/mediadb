Filtern nach Kategorie
<select id="filter" v-model="filter" name="filter">
    <option v-for="category in categories">@{{category.name}}</option>
</select>

@{{ filter }}