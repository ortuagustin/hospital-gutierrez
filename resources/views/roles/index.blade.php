@extends('layouts.master')

@section('content')

    <h1 class="title is-3 has-text-grey">Role List</h1>

    <div class="box level">
        <div class="level-left">
            {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'home', [], 'Back to Home', 'has-text-info') !!}
        </div>

        <div class="level-right">
            <div class="level-item">
                {!! link_to_with_icon('fas fa-plus fa-2x', 'roles.create', [], 'Create a new Role', 'has-text-success') !!}
            </div>
        </div>
    </div>

    {{ $roles->links('pagination._header') }}

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

    {{ $roles->links('pagination._header') }}

@endsection
