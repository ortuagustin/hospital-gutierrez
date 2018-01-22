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
            @include('nav.navbar')
        </div>

        @hasSection('hero-body-content')
            <div class="hero-body">
                <div class="container has-text-centered">
                    @yield('hero-body-content')
                </div>
            </div>
        @endif

        <div class="hero-foot">
            <nav class="tabs">
              <ul>
                 <li><a>Overview</a></li>
                 <li><a>Modifiers</a></li>
                 <li><a>Grid</a></li>
                 <li><a>Elements</a></li>
                 <li><a>Components</a></li>
                 <li><a>Layout</a></li>
              </ul>
            </nav>
        </div>
    </section>

    <section class="section">
        @yield('content')
    </section>

    <!-- Scripts -->
    @yield('scripts')
</body>

</html>
