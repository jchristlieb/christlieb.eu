<div class="container mx-auto relative">
    <div class="text-center pt-6 mb-8">
            <a class="uppercase tracking-wide bold text-grey-dark hover:text-blue px-6" href="#">@include('svg.menu-icon-left')<span>blog</span>@include('svg.menu-icon-right')</a>
            <a class="uppercase tracking-wide bold text-grey-dark hover:text-blue px-6" href="#">@include('svg.menu-icon-left')<span>about us</span>@include('svg.menu-icon-right')</a>
            <a class="uppercase tracking-wide bold text-grey-dark hover:text-blue px-6" href="#">@include('svg.menu-icon-left')<span>contact</span>@include('svg.menu-icon-right')</a>
    </div>
    <div class="flex items-stretch pt-8">
        <div class="self-center border-t-2 border-slate flex-1">&nbsp;</div>
        <div class="flex-1 text-center"><a class="leading-xl" href="{{ url('/') }}"><img src="{{asset('images/logo.png')}}" alt="logo" height="50"/></a></div>
        <div class="self-center border-t-2 border-slate flex-1">&nbsp;</div>
    </div>
    @auth
        <div class="absolute pin-t pin-l bg-red-light shadow p-3"><a class="text-white" href="{{route('admin.dashboard')}}">@include('svg.cogs')</a></div>
    @endauth
    <div class="absolute pin-t pin-r bg-red-light shadow p-3">@include('svg.rss')<p class="text-white text-xs tracking-xl">RSS</p></div>
</div>
