<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'christlieb.eu') . ' Admin | ' }}@yield('title', 'Dashboard')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="font-sans">
<div id="app">
    <flash></flash>
    @include('partials.header')
    <div class="container py-4 mx-auto">

        <div class="flex -mx-2">
            <aside class="p-3 w-1/4">
                <ul class="list-reset">
                    <li class="mb-4">
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{route('admin.articles.create')}}">New Article</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{route('admin.articles.index')}}">Articles</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{route('admin.tags.index')}}">Tags</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{route('admin.images.index')}}">Images</a>
                    </li>
                </ul>
            </aside>
            <main class="p-3 w-3/4">
                @yield('content')
            </main>
        </div>
    </div>
    @include('partials.footer')
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@include('flash::message')
</body>
</html>
