@extends('layouts.master')

@section('content')

<section class="section">

    <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
            <p class="title has-text-grey">Reset you Password</p>

            <div class="box">
                <form method="POST" action="{{ route('password.request') }}">
                    @include('auth.passwords._reset_form')
                </form>
            </div>
        </div>
    </div>

</section>

@endsection
