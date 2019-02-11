<select>
    @foreach ($categories as $category)
        <option value="{{$category->name}}">{{$category->name}}</option>
    @endforeach
</select>