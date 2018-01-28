@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">Add a Medical Record</h1>

    <form method="POST" action={{ route('patients.medical_records.store', [$patient]) }}>

        @include('medical_records._form', [
            'submitButtonText' => 'Create Medical Record',
        ])
    </form>
@endsection
