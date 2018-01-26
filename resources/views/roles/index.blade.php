@extends('layouts.master')

@section('content')

    <h1 class="title is-3 has-text-grey">Role List</h1>

    <div class="box">
        {!! link_to_with_icon('fas fa-plus fa-lg', 'roles.create', [], 'Create a new Role', 'has-text-success') !!}
    </div>

    {{ $roles->links('layouts._pagination') }}

    <div class="box">

        <table class="table is-striped is-narrow">

            <thead>
                <tr>
                    <th><abbr title="Number">#</abbr></th>
                    <th>Name</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <th>{{ $role->id }}</th>
                        <td>{{ $role->name }}</td>
                        <td> {!! link_to_with_icon('fas fa-info-circle fa-2x', 'roles.show', $role->id, '', 'has-text-info') !!} </td>
                        <td> {!! link_to_with_icon('fas fa-edit fa-2x', 'roles.edit', $role, '', 'has-text-dark') !!} </td>
                        <td> {!! delete_link_with_icon('fas fa-trash-alt fa-2x', 'roles.destroy', $role) !!} </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    {{ $roles->links('layouts._pagination') }}

@endsection
