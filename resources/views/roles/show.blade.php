@extends('layouts.app')

@section('content')
    <h1 class="title is-3"> Role: {{ $role->name }} </h1>
    <h2 class="subtitle">Permissions</h2>

    {!! link_to_with_icon('fas fa-plus fa-lg', 'permissions.create', [], 'Create a new Permission', 'has-text-success') !!}

    <table class="table is-striped">
        <thead>
            <tr>
                <th><abbr title="Number">#</abbr></th>
                <th>Name</th>
                <th>Remove from Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($role->permissions as $permission)
                <tr>
                    <th>{{ $permission->id }}</th>
                    <td>{{ $permission->name }}</td>
                    <td> {!! delete_link_with_icon('fas fa-trash-alt fa-2x', '') !!} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
