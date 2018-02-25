@extends('layouts.master')

@section('content')

<div class="columns is-multiline is-centered">
    @foreach ($reports as $each)
        <div class="column is-one-third">
            <pie-chart
                endpoint={{ $each->endpoint() }}
                title="{{ $each->title() }}">
            </pie-chart>
        </div>
    @endforeach
</div>

@endsection
