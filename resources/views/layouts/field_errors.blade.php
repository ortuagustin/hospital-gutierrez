{{-- Will display validation errors for a given field  --}}

@if ($errors->has($field))
    <div class="container">
        <ul>
            @foreach ($errors->get($field) as $message)
                <li class="help has-text-weight-bold has-text-danger">
                    &nbsp; {{ $message }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
