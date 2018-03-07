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

        <table class="table is-striped is-narrow">

            <thead>
                <tr>
                    <th><abbr title="Number">#</abbr></th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Identification</th>
                    <th>Birth Date</th>
                    <th>Gender</th>
                    <th>Medical Insurance</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Details</th>

                    @can ('update', \App\Patient::class)
                        <th>Edit</th>
                    @endcan

                    @can ('delete', \App\Patient::class)
                        <th>Delete</th>
                    @endcan
                </tr>
            </thead>

            <tbody>
                @foreach ($patients as $patient)
                    <tr>
                        <th>{{ $patient->id }}</th>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->last_name }}</td>
                        <td>{{ $patient->document }}</td>
                        <th>{{ $patient->birth_date->toDateString() }}</th>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $patient->medicalInsurance->value() }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{!! link_to_with_icon('fas fa-info-circle fa-2x', 'patients.show', $patient->id, '', 'has-text-info') !!}</td>

                        @can ('update', $patient)
                            <td>{!! link_to_with_icon('fas fa-edit fa-2x', 'patients.edit', $patient, '', 'has-text-dark') !!}</td>
                        @endcan

                        @can ('delete', $patient)
                            <td> <delete-button route="{{route('patients.destroy', $patient) }}"></delete-button> </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $patients->links('pagination._footer') }}

    </div>
@endsection
