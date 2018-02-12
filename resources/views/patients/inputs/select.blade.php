<select id="{{ $name }}" name="{{ $name }}">
    @foreach ($values as $each)
        <option value="{{ $each->id() }}"> {{ $each->value() }}</option>
    @endforeach
</select>
