@extends('layouts.master')

@section('styles')
    @parent

    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('content')

<section class="section">

    <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
            <h3 class="title has-text-grey">Login</h3>
            <p class="subtitle has-text-grey">Please login to proceed.</p>

            <div class="box">
                <figure class="avatar"> <img src="logo.png"> </figure>

                <form method="POST" action="{{ route('login') }}">
                    @include('auth._login_form')
                </form>
            </div>

            <p class="field">
                {!! link_to('Register', 'register', [], 'has-text-grey has-text-weight-bold') !!}&nbsp;·&nbsp;
                {!! link_to('Forgot Password?', 'password.request', [], 'has-text-grey has-text-weight-bold') !!}
            </p>
        </div>
    </div>

</section>

@endsection
