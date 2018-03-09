<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'christlieb.eu') . ' | ' }}@yield('title', 'Home')</title>

    <script>
        WebFontConfig = {
            google: {
                families: ['Roboto', 'Roboto Condensed', 'Roboto Slab']
            },
            timeout: 2000 // Set the timeout to two seconds
        };
        (function (d) {
            let wf = d.createElement('script'), s = d.scripts[0];
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <!-- Styles -->
    @if(config('app.env') == 'production')
        <style>
            {{ file_get_contents(public_path('css/app.css')) }}
        </style>
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
</head>
<body class="font-sans">
<div id="app">
    <flash></flash>
    @include('partials.header')

    @yield('content')

    @include('partials.footer')
</div>

<!-- Scripts -->
@include('partials.google-analytics')
<script src="{{ asset('js/app.js') }}"></script>
@include('flash::message')
</body>
</html>
