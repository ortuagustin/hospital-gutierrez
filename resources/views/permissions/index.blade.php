@extends('layouts.master')

@section('content')

    <h1 class="title is-3 has-text-grey">Permissions List</h1>

    <div class="box">
        {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'home', [], 'Back to Home', 'has-text-info') !!}
    </div>

    {{ $permissions->links('pagination._header') }}

    <div class="box">

        <table class="table is-striped is-narrow is-fullwidth">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <th>{{ $permission->id }}</th>
                        <td>{{ $permission->name }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    {{ $permissions->links('pagination._footer') }}

@endsection
