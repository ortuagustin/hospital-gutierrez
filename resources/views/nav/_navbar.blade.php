<nav class="navbar is-primary is-transparent is-fixed-top">

    <div class="navbar-brand">
        <a class="navbar-item is-active" href="{{ route('home') }}">
            {!! icon('fas fa-home fa-2x') !!}
            &nbsp;&nbsp; Home
        </a>

        <span class="navbar-burger" data-target="navbar-menu">
            <span></span>
            <span></span>
            <span></span>
        </span>

    </div>

    <div class="navbar-menu" id="navbar-menu">

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
                @include('nav._logout_form')
            @endif
        </div>

    </div>

</nav>

@push('scripts')
    <script src="/js/navbar.js"></script>
@endpush
