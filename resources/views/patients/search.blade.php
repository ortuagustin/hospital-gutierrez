@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">Patient List</h1>

    <div class="box level">

        <div class="level-left">
            {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'home', [], 'Back to Home', 'has-text-info') !!}
        </div>

        @can ('create', \App\Patient::class)
            <div class="level-right">

                <div class="level-item">
                    {!! link_to_with_icon('fas fa-plus fa-2x', 'patients.create', [], 'Create a new Patient', 'has-text-success') !!}
                </div>

            </div>
        @endcan

    </div>

    <div id="app">
        <ais-index
            app-id="{{ config('scout.algolia.id') }}"
            api-key="{{ config('scout.algolia.key') }}"
            index-name="patients"
            query="{{ request('q') }}"
        >
            <div class="columns">
                <div class="column is-two-fifths">

                    <ais-search-box class="box"></ais-search-box>

                    <search-type-filter attribute-name="medical_insurance">Filter by Medical Insurance</search-type-filter>
                    <search-type-filter attribute-name="doc_type">Filter by Doc Type</search-type-filter>
                    <search-type-filter attribute-name="home_type">Filter by Home Type</search-type-filter>
                    <search-type-filter attribute-name="heating_type">Filter by Heating Type</search-type-filter>
                    <search-type-filter attribute-name="water_type">Filter by Water Type</search-type-filter>
                </div>

                <div class="column">
                    <patient-search-results attribute-name="full_name"></patient-search-results>
                </div>
            </div>
        </ais-index>
    </div>

@endsection
