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
            @component('components.inputs.checkbox', ['name' => 'value', 'value' => $setting->value])
                Check to put site on maintenance mode; only Admins will be allowed to browse.
            @endcomponent
        @endunless
    </th>

    <th>
        <div class="control">
            <button type="submit" class="button is-primary">Update</button>
        </div>
    </th>

</form>
