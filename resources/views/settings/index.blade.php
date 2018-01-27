@extends('layouts.master')

@section('content')

    <h1 class="title is-3 has-text-grey">System Settings</h1>

    {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'home', [], 'Back to Home', 'has-text-info') !!}

    @include('layouts._errors')

    <div class="box">

        <table class="table is-striped is-narrow">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Value</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($settings as $setting)
                    <tr>
                        @include('settings._form', ['$setting' => $setting])
                    </tr>
                @endforeach

            </tbody>

        </table>

        {!! link_to('Reset ALL to default values', 'settings.reset', [], 'has-text-danger') !!}
    </div>


@endsection
