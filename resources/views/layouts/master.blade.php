<!DOCTYPE html>
<html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ setting('title') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.4/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div id="app">
        @include('app._navbar')

        @include('app._hero')

        <section class="section">
            @yield('content')
        </section>

        <flash data-message="{{ session('flash') }}" data-type="{{ session('flash-type') }}"></flash>
    </div>

    <footer class="footer" id="footer">
        @include('app._footer')
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
