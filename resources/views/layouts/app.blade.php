<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.4/css/all.css">

    @yield('styles')
</head>

<body>
    <section class="hero is-primary is-small">
        <div class="hero-head">
            @include('nav._navbar')
        </div>

        <div class="hero-body">
            <div class="container has-text-centered">
                @hasSection('hero-body-content')
                    @yield('hero-body-content')
                @else
                    <h1 class="title">Hospital Dr. Ricardo Gutiérrez</h1>
                    <h2 class="subtitle">Consultorio del Niño Sano</h2>
                @endif
            </div>
        </div>

        @includeWhen(Auth::check(), 'nav._footer')
    </section>

    <section class="section">
        @yield('content')
    </section>

    <footer class="footer" style="padding-bottom: 0;">
        @include('layouts._footer')
    </footer>

    <!-- Scripts -->
    @yield('scripts')
</body>

</html>
