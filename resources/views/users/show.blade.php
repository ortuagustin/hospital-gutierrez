@extends('layouts.master')

@section('content')
    <p class="title is-3 has-text-grey">User Details</p>

    <div class="box">
        <p v-pre> <strong>ID:</strong> {{ $user->id }} </p>
        <p v-pre> <strong>Name:</strong> {{ $user->name }} </p>
        <p v-pre> <strong>Email:</strong> {{ $user->email }} </p>
    </div>

    <div class="box">
        <user-role-select :user="{{ $user }}" :roles="{{ $roles }}"></user-role-select>
    </div>
@endsection
