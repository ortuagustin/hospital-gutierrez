@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">Edit Patient</h1>

    {!! back_link() !!}

    <form method="POST" action={{ route('patients.update', $patient) }}>

        {{ method_field('PATCH') }}

        @include('patients._form', [
            'submitButtonText' => 'Update Patient',
        ])
    </form>
@endsection
