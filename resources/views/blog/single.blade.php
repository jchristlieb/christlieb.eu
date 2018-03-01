@extends('layouts.no-sidebar')

@section('title',  $article->title)

@section('content')
    <div class="container py-4 mx-auto">

        @if($newerArticle = $article->newerArticle())
            <div class="fixed pin-l pin-t h-full ">
                <div class="flex items-center h-full">
                    <div class="p-4 bg-grey-light self-center">
                        <a href="{{$newerArticle->path()}}">@include('svg.arrow-left', ['class' => 'fill-current h-8 w-8'])</a></div>
                </div>
            </div>
        @endif

        @if($olderArticle = $article->olderArticle())
            <div class="fixed pin-r pin-t h-full flex content-center flex-wrap">
                <div class="flex items-center h-full">
                    <div class="p-4 bg-grey-light">
                        <a href="{{$olderArticle->path()}}" >@include('svg.arrow-right', ['class' => 'fill-current h-8 w-8'])</a>
                    </div>
                </div>
            </div>
        @endif
        <div class="flex -mx-2">
            <main class="p-3 w-2/3 mx-auto">
                <article>
                    <header class="mb-4">
                        <div class="flex justify-between mb-6">
                            <div class="text-grey">{{$article->published_at->formatLocalized('%B %d,  %Y')}}</div>
                            <div class="flex text-grey">
                                <div class="pr-1">
                                    @include('svg.clock', ['class' => 'fill-current h-4 w-4'])
                                </div>
                                <div class="font-bold tracking-wide text-grey uppercase">
                                    {{$article->readingTime() }} min read&nbsp;&nbsp;|&nbsp;&nbsp;
                                </div>
                                <div class="text-blue flex">
                                    <div class="pr-1">
                                        @include('svg.comment', ['class' => 'fill-current h-4 w-4'])</div>
                                    <div class="font-bold tracking-wide uppercase">
                                        <a href="#">2 comments</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">{{$article->title}}</h1>
                        <div class="mb-4 pb-6 border-b-2 border-slate">
                            @foreach($article->tags as $tag)
                                <a href="{{route('tags.show', $tag->slug)}}">
                                    <span class="text-sm text-white bg-grey py-1 px-2 mr-2">{{$tag->name}}</span>
                                </a>
                            @endforeach
                        </div>
                        <div class="py-4 text-xl leading-normal font-serif">
                            {{$article->getExcerpt(30)}}
                        </div>
                        @if($article->image)
                            <img src="{{Storage::url($article->image->path)}}" class="w-full"/>
                        @endif
                    </header>
                    <div class="font-serif leading-loose">
                        {!! $article->content !!}
                    </div>
                </article>
            </main>
        </div>
    </div>


@endsection
