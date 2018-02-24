@extends('layouts.master')

@section('content')

@foreach ($reports->chunk(3) as $chunk)
    @foreach ($chunk as $each)        
        <div class="columns">

            <div class="column is-one-third">
                <pie-chart endpoint={{ $each->endpoint() }} title={{ $each->name() }}></pie-chart>
            </div>

            <div class="column is-one-third">
                <bar-chart endpoint={{ $each->endpoint() }} title={{ $each->name() }}></bar-chart>
            </div>

            <div class="column is-one-third">
                <line-chart endpoint={{ $each->endpoint() }} title={{ $each->name() }}></line-chart>
            </div>

        </div>
    @endforeach
@endforeach

@endsection
