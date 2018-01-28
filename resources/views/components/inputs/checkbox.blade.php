{{--  trick for handling checkboxes --}}
{{-- when uncheked, no value is sent to the server --}}
{{-- see https://github.com/laravel/framework/issues/14226 --}}

<div class="control">
    <input type="hidden" name={{ $name }} value="0">
    <label class="checkbox {{ $label_class or '' }}">
        <input class="{{ $input_class or '' }}" type="checkbox" name={{ $name }} value="1" @if ($value) checked @endif>

        {{ $slot }}
    </label>
</div>
