@extends('layouts.master')

@section('content')

    <h1 class="title is-3 has-text-grey">Permissions List</h1>

    <div class="box">
        {!! link_to_with_icon('fas fa-plus fa-lg', 'permissions.create', [], 'Create a new Permission', 'has-text-success') !!}
    </div>

    {{ $permissions->links('pagination._header') }}

    <div class="box">

        <table class="table is-striped is-narrow">

            <thead>
                <tr>
                    <th><abbr title="Number">#</abbr></th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <th>{{ $permission->id }}</th>
                        <td>{{ $permission->name }}</td>
                        <td> {!! link_to_with_icon('fas fa-edit fa-2x', 'permissions.edit', $permissions, '', 'has-text-dark') !!} </td>
                        <td> {!! delete_link_with_icon('fas fa-trash-alt fa-2x', 'permissions.destroy', $permissions) !!} </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    {{ $permissions->links('pagination._footer') }}

@endsection
