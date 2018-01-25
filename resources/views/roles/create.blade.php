@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">Create a New Role</h1>

    <form method="POST" action={{ route('roles.store') }}>

        @include('roles._form', [
            'submitButtonText' => 'Create Role',
        ])
    </form>
@endsection
