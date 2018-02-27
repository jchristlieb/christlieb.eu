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
    <flash></flash>
    @include('partials.navbar')
    <div class="container py-4 mx-auto">
        <div class="flex -mx-2">
            <aside class="p2">
                <ul class="nav flex-column pt-5">
                    <li class="nav-item mb-4">
                        <i class="fal fa-cogs"></i>
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="nav-item mb-4">
                        <i class="fal fa-newspaper"></i>
                        <a href="{{route('admin.articles.create')}}">New Article</a>
                    </li>
                    <li class="nav-item mb-4">
                        <i class="fal fa-newspaper"></i>
                        <a href="{{route('admin.articles.index')}}">Articles</a>
                    </li>
                    <li class="nav-item mb-4">
                        <i class="fal fa-tags"></i>
                        <a href="{{route('admin.tags.index')}}">Tags</a>
                    </li>
                    <li class="nav-item mb-4">
                        <i class="fal fa-images"></i>
                        <a href="{{route('admin.images.index')}}">Images</a>
                    </li>
                </ul>
            </aside>
            <main class="p-2">
                @yield('content')
            </main>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@include('flash::message')
</body>
</html>
