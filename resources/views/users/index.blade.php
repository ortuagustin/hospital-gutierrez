@extends('layouts.master')

@section('content')

    <h1 class="title is-3 has-text-grey">User List</h1>

    <div class="box">

        {{ $users->links('pagination._header') }}

        <table class="table is-striped is-narrow">

            <thead>
                <tr>
                    <th><abbr title="ID">#</abbr></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Details</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles_names() }}</td>
                        <td> {!! link_to_with_icon('fas fa-info-circle fa-2x', 'users.show', $user->id, '', 'has-text-info') !!} </td>
                        @if (Auth::id() != $user->id)
                            <td> {!! delete_link_with_icon('fas fa-trash-alt fa-2x', 'users.destroy', $user) !!} </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    {{ $users->links('pagination._footer') }}

@endsection
