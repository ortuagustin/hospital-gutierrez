@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/503.css') }}">
@endpush

@section('content')
    <div class="container has-text-centered">
        <h1 class="title">Sorry, We're under Maintenance</h1>
        <h2 class="subtitle">We'll be back soon!</h2>

        @guest
            <p class="subtitle is-5">
                If you're an Administrator, you may log in and <a @click="$modal.show('login')">access the site</a>
                </p>
        @endguest

        @auth
            <p class="subtitle is-5">Please contact an Administrator for details</p>
        @endauth

    </div>
@endsection
