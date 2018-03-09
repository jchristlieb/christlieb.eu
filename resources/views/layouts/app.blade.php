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
        (function(d) {
            let wf = d.createElement('script'), s = d.scripts[0];
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <!-- Styles -->
    {{--<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto+Slab:400,700|Roboto:400,700" rel="stylesheet" lazyload>--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans">
<div id="app">
    <flash></flash>
    @include('partials.header')
    <div class="container py-4 px-2 mx-auto">

        <div class="flex flex-wrap -mx-2">
            <main class="w-full md:w-2/3">
                @yield('content')
            </main>
            <aside class="w-full md:w-1/3">
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
