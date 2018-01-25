@extends('layouts.master')

@section('content')

    <p class="title is-3 has-text-grey"> {{ $patient->full_name }} </p>

    @component('components.patients.details', ['patient' => $patient])
        <p class='title is-6 has-text-grey'>Patient Details</p>
    @endcomponent

    <div class="box">
        <p> <strong>User:</strong> {{ $medical_record->user_name }} </p>
        <p> <strong>Date:</strong> {{ $medical_record->fecha->toDateString() }} </p>
        <p> <strong>Weight:</strong> {{ $medical_record->peso }} </p>
        <p> <strong>Height:</strong> {{ $medical_record->talla }} </p>
        <p> <strong>Cefalic Percentil:</strong> {{ $medical_record->percentilo_cefalico }} </p>
        <p> <strong>Perimeter Cefalic Percentil:</strong> {{ $medical_record->percentilo_perimetro_cefalico }} </p>
        <p> <strong>Vaccines OK?:</strong> @include('layouts._check', ['value' => $medical_record->vacunas_completas]) </p>
        <p> <strong>Rippening OK?:</strong> @include('layouts._check', ['value' => $medical_record->maduracion_acorde]) </p>
        <p> <strong>Physical Test OK?:</strong> @include('layouts._check', ['value' => $medical_record->examen_fisico_normal]) </p>
    </div>

    <div class="box">
        <div class="field is-grouped is-grouped-centered">
            <p class="control">
                {!! link_to_with_icon('fas fa-clock fa-2x', 'patients.medical_records.index', $patient, 'View Medical Records', 'has-text-info') !!}
            </p>

            <p class="control">
                {!! delete_link_with_icon('fas fa-trash-alt fa-2x', 'patients.medical_records.destroy', [$patient, $medical_record], 'Delete Medical Record', 'has-text-danger') !!}
            </p>
        </div>
    </div>

@endsection
