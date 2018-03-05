@if (Auth::guest())
    @include('auth._login')
    @include('auth._register')
@else
    <div class="navbar-item">
        <p>
            {!! icon('fas fa-user fa-lg') !!}

            Welcome, {{ Auth::user()->name }}
        </p>
    </div>

    @include('nav._logout_form')
@endif