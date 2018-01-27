@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">Role: {{ $role->name }}</h1>

    {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'roles.index', [], 'Back to Roles', 'has-text-info') !!}<br>

    <h2 class="subtitle">Permissions</h2>

    <div class="box">

        <table class="table is-striped is-narrow">

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
                        <td> <p class='has-text-danger has-text-centered' {!! icon('fas fa-trash-alt fa-2x') !!} </p> </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
@endsection
