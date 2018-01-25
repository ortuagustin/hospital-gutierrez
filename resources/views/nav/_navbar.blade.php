<nav class="navbar">
    <div class="navbar-brand">
        <a class="navbar-item">
            <img src="https://bulma.io/images/bulma-type-white.png" alt="Logo">
        </a>

        <span class="navbar-burger" data-target="navbar-menu">
            <span></span>
            <span></span>
            <span></span>
        </span>

    </div>

    <div id="navbar-menu" class="navbar-menu">

        <div class="navbar-end">
            @if (Auth::guest())
                {!! link_to('Login', 'login', [], 'navbar-item') !!}
                {!! link_to('Register', 'register', [], 'navbar-item') !!}
            @else
                <div class="navbar-item">
                    <p>
                        {!! icon('fas fa-user fa-lg') !!}
                         Welcome, {{ Auth::user()->name }}
                    </p>
                </div>
                {!! link_to('Home', 'home', [], 'navbar-item is-active') !!}
                @include('nav._logout_form')
            @endif
        </div>

    </div>
</nav>

@section('scripts')
    <script src="/js/navbar.js"></script>
@endsection
