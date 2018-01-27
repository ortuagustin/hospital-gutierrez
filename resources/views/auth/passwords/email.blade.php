@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="/css/passwords.email.css">
@endsection

@section('content')

<section class="section">

    <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
            <p class="title has-text-grey">Reset Password</p>

            @if (session('status'))
                <div class="notification is-success">
                    {{ session('status') }}
                </div>
            @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @include('auth.passwords._email_form')
                </form>
            </div>
        </div>
    </div>

</section>

@endsection
