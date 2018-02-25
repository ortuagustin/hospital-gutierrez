@extends('layouts.master')

@section('content')

@foreach ($reports->chunk(3) as $chunk)
    @foreach ($chunk as $each)
        <div class="columns">
            <div class="column is-one-third">
                <pie-chart
                    endpoint={{ $each->endpoint() }}
                    title="{{ $each->title() }}">
                </pie-chart>
            </div>
        </div>
    @endforeach
@endforeach

@endsection
