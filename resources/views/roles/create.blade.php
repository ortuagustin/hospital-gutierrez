@extends('layouts.app')

@section('content')
    <h1 class="title is-3">Create a New Role</h1>

    <form method="POST" action={{ route('roles.store') }}>

        @include('roles._form', [
            'submitButtonText' => 'Create Role',
        ])
    </form>
@endsection
