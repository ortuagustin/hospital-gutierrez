@extends('layouts.app')

@section('content')
    <h1 class="title is-3"> Edit Permission </h1>

    <form method="POST" action={{ route('permissions.update', $permission) }}>

        {{ method_field('PATCH') }}

        @include('permissions._form', [
            'submitButtonText' => 'Update Permission',
        ])
    </form>
@endsection
