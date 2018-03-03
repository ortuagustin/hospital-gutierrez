@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">Patient Search</h1>

    @include('patients._list_header')

    <div id="app">
        <ais-index
            app-id="{{ config('scout.algolia.id') }}"
            api-key="{{ config('scout.algolia.key') }}"
            index-name="patients"
            query="{{ request('q') }}"
            :query-parameters="{
                hitsPerPage: {{ setting('records_per_page') }}
            }"
        >
            <div class="columns">
                <div class="column is-two-fifths">
                    <clear-search-filters></clear-search-filters>
                    <patients-search-box attribute-per-page="{{ setting('records_per_page') }}"></patients-search-box>
                    <search-age-filter></search-age-filter>
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
