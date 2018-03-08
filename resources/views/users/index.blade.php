@extends('layouts.master')

@section('content')
    <h1 class="title is-3 has-text-grey">User List</h1>

    <div class="box">
        {{ $users->links('pagination._header') }}

        @include('users._table')

        {{ $users->links('pagination._footer') }}
    </div>
@endsection
