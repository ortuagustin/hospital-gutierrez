@extends('layouts.master')

@section('content')
    {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'patients.index', [], 'Back', 'has-text-info') !!}

    <div class="box">
        <p class="title is-3 has-text-grey"> {{ $patient->full_name }} </p>

        <br>

        <vue-report-view endpoint="{{ route('patients.reports', $patient) }}"></vue-report-view>
    </div>
@endsection
