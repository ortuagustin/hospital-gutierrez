@extends('layouts.master')

@section('content')

    <h1 class="title is-3 has-text-grey"> Medical Records </h1>
    <h3 class="subtitle is-5 has-text-grey"> {{ $patient->full_name }} </h3>


    <div class="box level">

        <div class="level-left">

            <div class="level-item">{!! link_to_with_icon('fas fa-arrow-left fa-2x', 'patients.index', [], 'Back to Patients', 'has-text-info') !!}</div>

            <div class="level-item">
                {!! link_to_with_icon('fas fa-user fa-2x', 'patients.show', $patient, "Back to $patient->full_name", 'has-text-primary') !!}
            </div>

        </div>

        @can ('create', \App\MedicalRecord::class)
            <div class="level-right">

                <div class="level-item">
                    {!! link_to_with_icon('fas fa-plus fa-2x', 'patients.medical_records.create', $patient, 'Add Medical Record', 'has-text-success') !!}
                </div>

            </div>
        @endcan

    </div>

    {{ $medical_records->links('pagination._header') }}

    <div class="box">

        <table class="table is-striped is-narrow">

            <thead>
                <tr>
                    <th>Date</th>
                    <th>Age</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>CP</th>
                    <th>CPP</th>
                    <th>Vaccines?</th>
                    <th>Ripening?</th>
                    <th>Physical Test?</th>
                    <th>User</th>

                    @can ('view', \App\MedicalRecord::class)
                        <th>Details</th>
                    @endcan

                    @can ('delete', \App\MedicalRecord::class)
                        <th>Delete</th>
                    @endcan
                </tr>
            </thead>

            <tbody>
                @foreach ($medical_records as $medical_record)
                    <tr>
                        <th> {{ $medical_record->fecha ->toDateString() }}</th>
                        <td> {{ $medical_record->patient_age }} </td>
                        <td> {{ $medical_record->peso }} </td>
                        <td> {{ $medical_record->talla }} </td>
                        <th> {{ $medical_record->percentilo_cefalico }} </th>
                        <td> {{ $medical_record->percentilo_perimetro_cefalico }} </td>
                        <td> @include ('layouts._centered-check', ['value' => $medical_record->vacunas_completas ]) </td>
                        <td> @include ('layouts._centered-check', ['value' => $medical_record->maduracion_acorde ]) </td>
                        <td> @include ('layouts._centered-check', ['value' => $medical_record->examen_fisico_normal ]) </td>
                        <td> {{ $medical_record->user_name }} </td>

                        @can ('view', $medical_record)
                            <td> {!! link_to_with_icon('fas fa-info-circle fa-2x', 'patients.medical_records.show', [$patient, $medical_record], '', 'has-text-info') !!} </td>
                        @endcan

                        @can ('delete', $medical_record)
                            <td> {!! delete_link_with_icon('fas fa-trash-alt fa-2x', 'patients.medical_records.destroy', [$patient, $medical_record]) !!} </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    {{ $medical_records->links('pagination._footer') }}

@endsection
