@extends('layouts.app')

@section('content')
    <h1 class="title is-3"> Create a New Patient </h1>

    <form method="POST" action={{ route('patients.store') }}>

        @include('patients._form', [
            'submitButtonText' => 'Create Patient',
        ])
    </form>
@endsection
