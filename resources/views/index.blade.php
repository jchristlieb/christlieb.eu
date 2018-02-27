@extends('layouts.app')

@section('title',  'Welcome')
@section('content')

    <main class="flex flex-wrap -mx-4">
        @foreach($promotedArticles as $article)

            <div class="px-4{{ $loop->first ?' w-full' : ' w-1/2' }}">

                <article class="card border rounded mb-4">
                    <header>
                        @if($article->image)
                            <img src="{{Storage::url($article->image->path)}}" class="mw-100"/>
                        @endif
                        <div class="p-4">
                            <h3><a href="{{$article->path()}}">{{$article->title}}</a></h3>
                            @if($article->updated_at != $article->created_at)
                                <p>updated at: {{$article->updated_at}}</p>
                            @endif
                            <p class=" border-b pb-8">by {{$article->author->name}} on {{$article->created_at}} in
                                @foreach($article->tags as $tag)
                                    <a href="{{route('tags.show', $tag->slug)}}"><span
                                                class="badge badge-primary">{{$tag->name}}</span></a>
                                @endforeach
                            </p>
                        </div>
                    </header>
                    <main class="p-4">{{ $article->getExcerpt()  }}</main>
                </article>

            </div>

        @endforeach

    </main>


@endsection

@section('sidebar')
    @widget('LatestArticleWidget')
    @widget('TagsWidget')
@endsection
