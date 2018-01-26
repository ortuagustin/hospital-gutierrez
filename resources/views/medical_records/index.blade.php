@extends('layouts.master')

@section('content')

    <h1 class="title is-3 has-text-grey"> Medical Records </h1>
    <h3 class="subtitle is-5 has-text-grey"> {{ $patient->full_name }} </h3>


    <div class="box">
        {!! link_to_with_icon('fas fa-plus fa-lg', 'patients.medical_records.create', $patient, 'Create a new Medical Record', 'has-text-success') !!}
    </div>

    {{ $medical_records->links('layouts._pagination') }}

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
                    <th>Details</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($medical_records as $medical_record)
                    <tr>
                        <th> {{ $medical_record->fecha ->toDateString() }}</th>
                        <td> {{ $patient->age }} </td>
                        <td> {{ $medical_record->peso }} </td>
                        <td> {{ $medical_record->talla }} </td>
                        <th> {{ $medical_record->percentilo_cefalico }} </th>
                        <td> {{ $medical_record->percentilo_perimetro_cefalico }} </td>
                        <td> @include ('layouts._centered-check', ['value' => $medical_record->vacunas_completas ]) </td>
                        <td> @include ('layouts._centered-check', ['value' => $medical_record->maduracion_acorde ]) </td>
                        <td> @include ('layouts._centered-check', ['value' => $medical_record->examen_fisico_normal ]) </td>
                        <td> {{ $medical_record->user_name }} </td>
                        <td> {!! link_to_with_icon('fas fa-info-circle fa-2x', 'patients.medical_records.show', [$patient, $medical_record], '', 'has-text-info') !!} </td>
                        <td> {!! delete_link_with_icon('fas fa-trash-alt fa-2x', 'patients.medical_records.destroy', [$patient, $medical_record]) !!} </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    {{ $medical_records->links('layouts._pagination') }}

@endsection
