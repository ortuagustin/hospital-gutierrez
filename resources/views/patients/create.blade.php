@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">Create a New Patient</h1>

    {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'patients.index', [], 'Back to Patients', 'has-text-info') !!}

    <form method="POST" action={{ route('patients.store') }}>

        @include('patients._form', [
            'submitButtonText' => 'Create Patient',
        ])
    </form>
@endsection
