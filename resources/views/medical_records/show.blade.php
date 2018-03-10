@extends('layouts.master')

@section('content')
    <div v-pre>
        <p class="title is-3 has-text-grey"> {{ $patient->full_name }} </p>

        {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'patients.medical_records.index', $patient, 'Back to Medical Records', 'has-text-info') !!}

        @component('components.patients.details', ['patient' => $patient])
            <p class='title is-6 has-text-grey'>Patient Details</p>
        @endcomponent

        <div class="box">
            <p> <strong>User:</strong> {{ $medical_record->user_name }} </p>
            <p> <strong>Control date:</strong> {{ $medical_record->fecha->toDateString() }} </p>
            <p> <strong>Age when took this control:</strong> {{ "$medical_record->patient_age years" }} </p>
            <p> <strong>Weight:</strong> {{ $medical_record->peso }} </p>
            <p> <strong>Height:</strong> {{ $medical_record->talla }} </p>
            <p> <strong>Cefalic Percentil:</strong> {{ $medical_record->percentilo_cefalico }} </p>
            <p> <strong>Perimeter Cefalic Percentil:</strong> {{ $medical_record->percentilo_perimetro_cefalico }} </p>
        </div>

        <div class="box">
            <div> <strong>Vaccines OK?:</strong> {!! check_icon($medical_record->vacunas_completas) !!}</div>
            <div> <strong>Vaccines Observations:</strong> {{ $medical_record->vacunas_observaciones }} </div>
        </div>

        <div class="box">
            <div> <strong>Rippening OK?:</strong> {!! check_icon($medical_record->maduracion_acorde) !!} </div>
            <p> <strong>Rippening Observations:</strong> {{ $medical_record->maduracion_observaciones }} </p>
        </div>

        <div class="box">
            <div> <strong>Physical Test OK?:</strong> {!! check_icon($medical_record->examen_fisico_normal) !!} </div>
            <p> <strong>Physical Test Observations:</strong> {{ $medical_record->examen_fisico_observaciones }} </p>
        </div>

        <div class="box">
            <p> <strong>Feeding Observations:</strong> {{ $medical_record->maduracion_observaciones }} </p>
        </div>

        <div class="box">
            <p> <strong>General Observations:</strong> {{ $medical_record->observaciones }} </p>
        </div>
    </div>
@endsection
