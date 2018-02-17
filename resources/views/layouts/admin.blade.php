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
<body>
<div id="app">
    @include('partials.navbar')
    <div class="container py-4">
        @include('flash::message')
        <div class="row">
            <aside class="col-md-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <i class="fal fa-newspaper fa-lg"></i> Blog
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.articles.index')}}">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.tags.index')}}">Tags</a>
                    </li>
                </ul>
            </aside>
            <main class="col-md-9">
                @yield('content')
            </main>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
