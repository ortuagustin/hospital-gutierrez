@extends('layouts.master')

@section('content')

<section class="section">

    <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
            <p class="title has-text-grey">Register</p>
            <p class="subtitle has-text-grey">Create a new User</p>

            <div class="box">
                <form method="POST" action="{{ route('register') }}">
                    @include('auth._register_form')
                </form>
            </div>

            <p class="field">
                {!! link_to('Have an account?', 'login', [], 'has-text-grey has-text-weight-bold') !!}&nbsp;·&nbsp;
                {!! link_to('Forgot Password?', 'password.request', [], 'has-text-grey has-text-weight-bold') !!}
            </p>
        </div>
    </div>

</section>

@endsection
