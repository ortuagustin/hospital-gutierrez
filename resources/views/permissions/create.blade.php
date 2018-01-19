@extends('layouts.app')

@section('content')
    <h1 class="title is-3"> Create a New Permission </h1>

    <form method="POST" action={{ route('permissions.store') }}>

        @include('permissions._form', [
            'submitButtonText' => 'Create Permission',
        ])
    </form>
@endsection
