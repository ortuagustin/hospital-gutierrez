@extends('layouts.app')

@section('content')
    <h1 class="title is-3"> Patient List </h1>

    {!! link_to_with_icon('fas fa-plus fa-lg', 'patients.create', [], 'Create a new Patient', 'has-text-success') !!}

    <table class="table is-striped">
        <thead>
            <tr>
                <th><abbr title="Number">#</abbr></th>
                <th>Name</th>
                <th>Last Name</th>
                <th>DNI</th>
                <th>Birth Date</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Medical Insurance</th>
                <th>Home Type</th>
                <th>Heating Type</th>
                <th>Water Type</th>
                <th>Refrigerator?</th>
                <th>Electricity?</th>
                <th>Pets?</th>
                <th>View</th>
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
                    <td>{{ $patient->address }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->medicalInsurance->value() }}</td>
                    <th>{{ $patient->homeType->value() }}</th>
                    <td>{{ $patient->heatingType->value() }}</td>
                    <td>{{ $patient->waterType->value() }}</td>
                    <td>{{ $patient->has_refrigerator }}</td>
                    <td>{{ $patient->has_electricity }}</td>
                    <td>{{ $patient->has_pet }}</td>
                    <td> {!! link_to_with_icon('fas fa-info-circle fa-2x', 'patients.show', $patient->id, '', 'has-text-info') !!} </td>
                    <td> {!! link_to_with_icon('fas fa-edit fa-2x', 'patients.edit', $patient, '', 'has-text-dark') !!} </td>
                    <td> {!! delete_link_with_icon('fas fa-trash-alt fa-2x', 'patients.destroy', $patient) !!} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
