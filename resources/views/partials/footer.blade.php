<div class="container mx-auto px-4  mb-8">
    <div class="border-t-2 border-slate">
        <div class="text-center pt-8">
            <a href="https://twitter.com/bambamboole1" target="_blank" rel="noopener" aria-label="Twitter" class="p-4 text-grey-dark hover:text-blue">
                @svg('brands.twitter', 'fill-current h-8 w-8')
            </a>
            <a href="https://github.com/bambamboole" target="_blank" rel="noopener" aria-label="Github" class="p-4 text-grey-dark hover:text-blue">
                @svg('brands.github', 'fill-current h-8 w-8')
            </a>
            <a href="https://www.xing.com/profile/Manuel_Christlieb" rel="noopener" aria-label="Xing" target="_blank"
               class="p-4 text-grey-dark hover:text-blue">
                @svg('brands.xing', 'fill-current h-8 w-8')
            </a>
        </div>
        <div class="text-center pt-8 text-grey text-sm tracking-wide">
            <a class="text-grey hover:text-blue" aria-label="Legal Notice" href="{{route('legal-notice')}}">Legal
                Notice</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="text-grey hover:text-blue" aria-label="Privacy"
                                                      href="{{route('privacy')}}">Privacy</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
                    class="text-grey hover:text-blue"
                    href="{{route('feeds.main')}}" aria-label="RSS">RSS</a>&nbsp;&nbsp;|&nbsp;&nbsp;<span>&copy; {{date('Y')}}
                christlieb.eu</span>
        </div>
    </div>
</div>
