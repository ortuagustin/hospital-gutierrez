@extends('layouts.master')

@section('content')

    <h1 class="title is-3 has-text-grey">Systen Settings</h1>

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

    </div>

@endsection
