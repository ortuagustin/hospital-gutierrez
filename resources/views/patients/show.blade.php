@extends('layouts.app')

@section('content')
    <p class="title is-3 has-text-weight-light has-text-grey"> {{ $patient->full_name }} </p>

    <div class="card">
        <header class="card-header">
            <p class="card-header-title"> Details </p>
        </header>

        <div class="card-content">
            <div class="box">
                <p> <strong> Phone: </strong> {{ $patient->phone }} </p>
                <p> <strong> Address: </strong> {{ $patient->address }} </p>
                <p> <strong> Document: </strong> {{ $patient->document }} </p>
                <p> <strong> Gender: </strong> {{ ucfirst($patient->gender) }} </p>
                <p> <strong> Medical Insurance: </strong> {{ $patient->medicalInsurance->value() }} </p>
                <p> <strong> Birth Date: </strong> {{ $patient->birth_date_with_age }} </p>
            </div>

            <div class="box">
                <p> <strong> Home Type: </strong> {{ $patient->homeType->value() }} </p>
                <p> <strong> Water Type: </strong> {{ $patient->waterType->value() }} </p>
                <p> <strong> Heating Type: </strong> {{ $patient->heatingType->value() }} </p>
                <p> <strong> Gender: </strong> {{ $patient->medicalInsurance->value() }} </p>
                <p> <strong> Has Pets?: </strong> @include('patients._check', ['value' => $patient->has_pet]) </p>
                <p> <strong> Has Electricity?: </strong> @include('patients._check', ['value' => $patient->has_electricity]) </p>
                <p> <strong> Has Refrigerator?: </strong> @include('patients._check', ['value' => $patient->has_refrigerator]) </p>
            </div>
        </div>

        <div class="card-footer">
            <div class="card-footer-item">
                {!! link_button_with_icon('fas fa-clock fa-lg', 'patients.medical_records.index', $patient->id, 'View Medical Records', 'has-text-info') !!}
            </div>

            <div class="card-footer-item">
                {!! delete_button_with_icon('fas fa-trash-alt fa-lg', 'patients.destroy', $patient, 'Delete Patient') !!}
            </div>
        </div>
    </div>


@endsection
