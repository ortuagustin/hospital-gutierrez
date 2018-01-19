@extends('layouts.app')

@section('content')
    <h1 class="title is-3"> Edit Role </h1>

    <form method="POST" action={{ route('roles.update', $role) }}>

        {{ method_field('PATCH') }}

        @include('roles._form', [
            'submitButtonText' => 'Update Role',
        ])
    </form>
@endsection
