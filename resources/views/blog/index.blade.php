@extends('layouts.no-sidebar')

@section('title',  'Blog')

@section('content')
    <div class="container py-4 mx-auto">

        <div class="flex -mx-2">
            <main class="p-3 md:w-2/3 mx-auto">
                @foreach($articles as $article)
                    <article>
                        <header class="mb-4">
                            <div class="flex justify-between mb-6">
                                <div class="text-grey">{{$article->published_at->formatLocalized('%B %d,  %Y')}}</div>
                                <div class="flex text-grey">
                                    <div class="pr-1">
                                        @svg('regular.clock', 'fill-current h-4 w-4')
                                    </div>
                                    <div class="font-bold tracking-wide text-grey uppercase">
                                        {{$article->readingTime() }} min read&nbsp;&nbsp;|&nbsp;&nbsp;
                                    </div>
                                    <div class="text-blue flex">
                                        <div class="pr-1">
                                            @svg('regular.comment','fill-current h-4 w-4')
                                        </div>
                                        <div class="font-bold tracking-wide uppercase">
                                            <a href="#">2 comments</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="font-condensed font-bold text-4xl mb-4"><a class="text-grey-dark" href="{{$article->path()}}">{{$article->title}}</a> </h2>
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
                    </article>
                @endforeach

                {{$articles->links('pagination::simple-default')}}
            </main>
        </div>
    </div>
@endsection

