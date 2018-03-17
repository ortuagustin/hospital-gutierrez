@extends('layouts.master')

@section('content')
    {!! back_link() !!}

    <div class="box">
        <p class="title is-3 has-text-grey"> {{ $patient->full_name }} </p>

        <br>

        <vue-report-view endpoint="{{ route('patients.reports', $patient) }}"></vue-report-view>
    </div>
@endsection
