@extends('layouts.master')

@section('content')

<ul>
    @foreach ($reports as $each)
        <li>{{ $each }}</li>
    @endforeach
</ul>

<pie-chart endpoint="/reports/test"></pie-chart>

@endsection
