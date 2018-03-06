@extends('layouts.master')

@section('content')

    <h1 class="title is-3 has-text-grey">System Settings</h1>

    {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'home', [], 'Back to Home', 'has-text-info') !!}


    <div class="box">
        @foreach ($settings as $setting)
            @unless ($setting->input_type == 'checkbox')
                <setting-input :setting="{{ $setting }}" route="{{ route('settings.store') }}"></setting-input>
            @else
                <setting-checkbox :setting="{{ $setting }}" route="{{ route('settings.store') }}">
                    Check to put site on maintenance mode; only Admins will be allowed to browse.
                </setting-checkbox>
            @endunless
        @endforeach

        {!! link_to('Reset ALL to default values', 'settings.reset', [], 'button is-danger') !!}
    </div>

@endsection
