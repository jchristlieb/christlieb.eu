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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans">
<div id="app">
    <flash></flash>
    @include('partials.header')
    <div class="container py-4 mx-auto">

        <div class="flex -mx-2">
            <main class="p-3 w-2/3">
                @yield('content')
            </main>
            <aside class="p-3 w-1/3">
                @yield('sidebar')
            </aside>
        </div>
    </div>
    @include('partials.footer')
</div>

<!-- Scripts -->
@include('partials.google-analytics')
<script src="{{ asset('js/app.js') }}"></script>
@include('flash::message')

</body>
</html>
