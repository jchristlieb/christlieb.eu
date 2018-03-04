<div class="container mx-auto relative">
    <div class="text-center pt-6 mb-8">
            <a class="uppercase tracking-wide bold text-grey-dark hover:text-blue px-6" href="{{route('blog')}}">@svg('custom.menu-icon-left')<span>blog</span>@svg('custom.menu-icon-right')</a>
            <a class="uppercase tracking-wide bold text-grey-dark hover:text-blue px-6" href="{{route('about-us')}}">@svg('custom.menu-icon-left')<span>about us</span>@svg('custom.menu-icon-right')</a>
            <a class="uppercase tracking-wide bold text-grey-dark hover:text-blue px-6" href="{{route('contact')}}">@svg('custom.menu-icon-left')<span>contact</span>@svg('custom.menu-icon-right')</a>
    </div>
    <div class="flex items-stretch pt-8">
        <div class="self-center border-t-2 border-slate flex-1">&nbsp;</div>
        <div class="flex-1 text-center -mt-2"><a class="leading-xl" href="{{ url('/') }}">@svg('custom.logo')</a></div>
        <div class="self-center border-t-2 border-slate flex-1">&nbsp;</div>
    </div>
    @auth
        <div class="absolute pin-t pin-l bg-red-light shadow p-3">
            <a class="text-white" href="{{route('admin.dashboard')}}">@svg('solid.cogs', 'fill-current h-6 w-6')</a>
        </div>
    @endauth
    <div class="absolute pin-t pin-r bg-red-light shadow p-3">
        <a href="{{route('feeds.main')}}" class="text-white">@svg('solid.rss', 'fill-current')<p class="text-xs tracking-xl">RSS</p></a>
    </div>
</div>
