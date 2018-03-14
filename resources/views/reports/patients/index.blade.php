@extends('layouts.master')

@section('content')
    @foreach ($reports as $each)
        <div class="column is-one-third">
            <vue-line-chart
                endpoint={{ $each->endpoint() }}
                title="{{ $each->title() }}">
            </vue-line-chart>
        </div>
    @endforeach
@endsection
