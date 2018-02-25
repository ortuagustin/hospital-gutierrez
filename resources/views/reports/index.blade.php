@extends('layouts.master')

@section('content')

@foreach ($reports->chunk(3) as $chunk)
    <div class="columns">
        @foreach ($chunk as $each)
            <div class="column is-one-third">
                <pie-chart
                    endpoint={{ $each->endpoint() }}
                    title="{{ $each->title() }}">
                </pie-chart>
            </div>
        @endforeach
</div>
@endforeach

@endsection
