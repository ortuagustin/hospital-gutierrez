@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="/css/503.css">
@endsection

@section('content')
    <div class="container has-text-centered">
        <h1 class="title">Sorry, We're under Maintenance</h1>
        <h2 class="subtitle">We'll be back soon!</h2>
        <p class="subtitle is-5">If you're an Admin, you may log in and {!!link_to('access the site', 'login', []) !!}</p>
    </div>
@endsection
