@if ($paginator->hasPages())
    <div class="flex justify-between">
        {{-- Next Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="disabled"><span>@lang('pagination.next')</span></div>
        @else
            <div><a href="{{ $paginator->previousPageUrl() }}" rel="next">@lang('pagination.next')</a></div>
        @endif

        {{-- Previous Page Link --}}
        @if ($paginator->hasMorePages())
            <div><a href="{{ $paginator->nextPageUrl() }}" rel="prev">@lang('pagination.previous')</a></div>
        @else
            <div class="disabled"><span>@lang('pagination.previous')</span></div>
        @endif

    </div>
@endif
