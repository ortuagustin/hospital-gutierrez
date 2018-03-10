<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.4/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div id="app">
        @include('nav._navbar')

        <section class="hero is-primary is-small">
            <div class="hero-body">
                <div class="container has-text-centered">
                    @hasSection('hero-body-content')
                        @yield('hero-body-content')
                    @else
                        <h1 class="title" v-pre>{{ setting('title') }}</h1>
                        <h2 class="subtitle" v-pre>{{ setting('description') }}</h2>
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

        <flash data-message="{{ session('flash') }}" data-type="{{ session('flash-type') }}"></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
