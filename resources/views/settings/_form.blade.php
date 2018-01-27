<form method="POST" action="{{ route('settings.store') }}">

    {{ csrf_field() }}

    <input class="hidden" type="hidden" name="key" value="{{ $setting->key }}">

    <th>
        <div class="control">
            <input class="input is-static" type="text" name="human_name" value="{{ $setting->human_name }}" readonly>
        </div>
    </th>

    <th>
        @unless ($setting->input_type == 'checkbox')
            <div class="control">
                <input class="input" type="{{ $setting->input_type }}" name="value" value="{{ $setting->value }}">
            </div>
        @else
            <div class="control">
                {{--  trick for handling checkboxes --}}
                {{-- when uncheked, no value is sent to the server --}}
                {{-- see https://github.com/laravel/framework/issues/14226 --}}
                <input type="hidden" name="value" value="0">
                <input type="checkbox" name="value" value="1" @if ($setting->value) checked @endif>
            </div>
        @endunless
    </th>

    <th>
        <div class="control">
            <button type="submit" class="button is-primary">Update</button>
        </div>
    </th>

</form>
