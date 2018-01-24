@extends('layouts.master')

@section('content')

    <p class="title is-3 has-text-grey">User Details</p>

    <div class="box">
        <p> <strong>ID:</strong> {{ $user->id }} </p>
        <p> <strong>Name:</strong> {{ $user->name }} </p>
        <p> <strong>Email:</strong> {{ $user->email }} </p>
    </div>

    <div class="box">
        <p class="title is-5 has-text-grey">Assigned Roles</p>

        <table class="table is-striped is-narrow">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($user->roles as $role)
                    <tr>
                        <th>{{ $role->id }}</th>
                        <td>{{ $role->name }}</td>
                        <td> {!! link_to_with_icon('fas fa-info-circle fa-2x', 'roles.show', $role, '', 'has-text-info') !!} </td>
                        {{-- TODO: delete the role relationship with the user --}}
                        {{-- <td> {!! delete_link_with_icon('fas fa-trash-alt fa-2x', '', [$user, $role]) !!} </td> --}}
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    <div class="box">
        {{-- TODO: here you can assign rles to the user --}}
        TODO: here you can assign rles to the user 
    </div>

@endsection
