<!DOCTYPE html>
<html class="has-navbar-fixed-top">
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('title') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.4/css/all.css">
    <link rel="stylesheet" href="/css/app.css">
    @stack('styles')

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
</head>

<body>
    @include('nav._navbar')

    <section class="hero is-primary is-small">
        <div class="hero-body">
            <div class="container has-text-centered">
                @hasSection('hero-body-content')
                    @yield('hero-body-content')
                @else
                    <h1 class="title">{{ setting('title') }}</h1>
                    <h2 class="subtitle">{{ setting('description') }}</h2>
                @endif
            </div>
        </div>

        @includeWhen(Auth::check(), 'nav._footer')
    </section>

    <section class="section" id="wrapper">
        @yield('content')
    </section>

    <footer class="footer" id="footer">
        @include('layouts._footer')
    </footer>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
