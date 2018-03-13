<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'christlieb.eu') . ' Admin | ' }}@yield('title', 'Dashboard')</title>

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
    {{--<flash></flash>--}}
    @include('flash::message')

    @include('partials.header')
    <div class="container py-4 mx-auto">

        <div class="flex">
            <aside class="p-3 w-1/4 mx-4">
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
                    <li class="mb-6 flex">
                        <div class="mr-3 text-grey-dark">
                            @svg('solid.info', 'fill-current h-4 w-4')
                        </div>
                        <a class="text-grey-dark text-sm" href="{{route('admin.system')}}">System Infos</a>
                    </li>
                </ul>
            </aside>
            <main class="py-8 w-3/4 mx-4">
                @yield('content')
            </main>
        </div>
    </div>
    @include('partials.footer')
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('javascript')
</body>
</html>
