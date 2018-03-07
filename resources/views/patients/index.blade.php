@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">Patient List</h1>

    @component('patients._list_header')
        <div class="level-item">
            {!! link_to_with_icon('fas fa-search fa-2x', 'patients.search', [], 'Advanced Search...', 'has-text-info') !!}
        </div>
    @endcomponent

    <div class="box">
        {{ $patients->links('pagination._header') }}

        @include('patients._table')

        {{ $patients->links('pagination._footer') }}
    </div>
@endsection
