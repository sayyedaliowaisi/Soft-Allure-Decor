<select
    name="category_id"
    class="w-full rounded-lg border-gray-300">

    @foreach($categories as $category)

        <option
            value="{{ $category->id }}">

            {{ $category->name }}

        </option>

    @endforeach

</select>