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


    <div class="box">
        {{ $roles->links('pagination._header') }}

        @include('roles._table')

        {{ $roles->links('pagination._footer') }}
    </div>
@endsection
