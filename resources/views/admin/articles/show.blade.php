@extends('layouts.admin')

@section('title',  'Article: ' . $article->title )

@section('content')

    <main class="py-3">
        <article>
            <header class="mb-4">
                <div class="flex justify-between mb-6">
                    <div class="text-grey">
                        <a href="{{route('admin.articles.edit', $article->id)}}" class="btn">Edit</a>
                        @if($article->is_published)
                            {{$article->published_at->formatLocalized('%B %d,  %Y')}}
                        @endif
                    </div>
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


@endsection


@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.11.0/prism.js"></script>
@endsection
