@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">Patient List</h1>

    <div class="box level">

        <div class="level-left">
            {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'home', [], 'Back to Home', 'has-text-info') !!}
        </div>

        <div class="level-right">

            <div class="level-item">
                {!! link_to_with_icon('fas fa-plus fa-2x', 'patients.create', [], 'Create a new Patient', 'has-text-success') !!}
            </div>

        </div>

    </div>

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
                    <th>Edit</th>
                    <th>Delete</th>
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
                        <td>{!! link_to_with_icon('fas fa-edit fa-2x', 'patients.edit', $patient, '', 'has-text-dark') !!}</td>
                        <td>{!! delete_link_with_icon('fas fa-trash-alt fa-2x', 'patients.destroy', $patient) !!}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $patients->links('pagination._footer') }}

    </div>
@endsection
