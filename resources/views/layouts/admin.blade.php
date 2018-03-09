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
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto+Slab:400,700|Roboto:400,700" rel="stylesheet" lazyload>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" lazyload>
</head>

<body class="font-sans">
<div id="app">
    <flash></flash>
    @include('partials.header')
    <div class="container py-4 mx-auto">

        <div class="flex -mx-2">
            <aside class="p-3 w-1/4">
                <ul class="list-reset">
                    <li class="mb-6 flex">
                        <div class="mr-3 text-grey-dark">
                            @svg('solid.cogs', 'fill-current h-4 w-4')
                        </div>
                        <a class="text-grey-dark text-sm" href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="mb-6 flex">
                        <div class="mr-3 text-grey-dark">
                            @svg('solid.pencil-alt', 'fill-current h-4 w-4')
                        </div>
                        <a class="text-grey-dark text-sm" href="{{route('admin.articles.create')}}">New Article</a>
                    </li>
                    <li class="mb-6 flex">
                        <div class="mr-3 text-grey-dark">
                            @svg('solid.newspaper', 'fill-current h-4 w-4')
                        </div>
                        <a class="text-grey-dark text-sm" href="{{route('admin.articles.index')}}">Articles</a>
                    </li>
                    <li class="mb-6 flex">
                        <div class="mr-3 text-grey-dark">
                            @svg('solid.tags', 'fill-current h-4 w-4')
                        </div>
                        <a class="text-grey-dark text-sm" href="{{route('admin.tags.index')}}">Tags</a>
                    </li>
                    <li class="mb-6 flex">
                        <div class="mr-3 text-grey-dark">
                            @svg('solid.images', 'fill-current h-4 w-4')
                        </div>
                        <a class="text-grey-dark text-sm" href="{{route('admin.images.index')}}">Images</a>
                    </li>
                    <li class="mb-6 flex">
                        <div class="mr-3 text-grey-dark">
                            @svg('solid.user-circle', 'fill-current h-4 w-4')
                        </div>
                        <a class="text-grey-dark text-sm" href="{{route('admin.profile.show')}}">Profile</a>
                    </li>
                </ul>
            </aside>
            <main class="py-8 w-3/4">
                @yield('content')
            </main>
        </div>
    </div>
    @include('partials.footer')
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@include('flash::message')
@yield('javascript')
</body>
</html>
