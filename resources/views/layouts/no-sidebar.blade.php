<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'christlieb.eu') . ' | ' }}@yield('title', 'Home')</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto+Slab:400,700|Roboto:400,700" rel="stylesheet" lazyload>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" lazyload>
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
