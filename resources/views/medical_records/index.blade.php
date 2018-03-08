@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey"> Medical Records </h1>
    <h3 class="subtitle is-5 has-text-grey"> {{ $patient->full_name }} </h3>


    <div class="box level">
        <div class="level-left">
            <div class="level-item"> {!! back_link() !!} </div>

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
        @include('medical_records._table')
    </div>

    {{ $medical_records->links('pagination._footer') }}
@endsection
