@extends('layouts.master')

@section('content')

<p class="title is-3 has-text-grey">User Details</p>

<div class="box">
    <p> <strong>ID:</strong> {{ $user->id }} </p>
    <p> <strong>Name:</strong> {{ $user->name }} </p>
    <p> <strong>Email:</strong> {{ $user->email }} </p>
</div>

<div class="box" id ="app">
    <user-role-select :user="{{ $user }}" :roles="{{ $roles }}"></user-role-select>
</div>

@endsection
