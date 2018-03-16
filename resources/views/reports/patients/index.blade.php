@extends('layouts.master')

@section('content')
    <vue-report-view endpoint="{{ route('patients.reports', $patient) }}"></vue-report-view>
@endsection
