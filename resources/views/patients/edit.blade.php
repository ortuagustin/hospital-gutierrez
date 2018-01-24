@extends('layouts.master')

@section('content')
    <h1 class="title is-3">Edit Patient</h1>

    <form method="POST" action={{ route('patients.update', $patient) }}>

        {{ method_field('PATCH') }}

        @include('patients._form', [
            'submitButtonText' => 'Update Patient',
        ])
    </form>
@endsection
