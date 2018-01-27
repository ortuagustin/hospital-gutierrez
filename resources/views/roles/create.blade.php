@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">Create a New Role</h1>

    {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'roles.index', [], 'Back to Roles', 'has-text-info') !!}

    <form method="POST" action={{ route('roles.store') }}>

        @include('roles._form', [
            'submitButtonText' => 'Create Role',
        ])
    </form>
@endsection
