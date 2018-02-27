@extends('layouts.app')

@section('title',  'Welcome')
@section('content')

    <div class="flex flex-wrap">
        @foreach($promotedArticles as $article)

        <div class="{{ $loop->first ?'w-full' : 'w-1/2' }}">

            <article class="card mb-4">
                <div class="card-header">
                    <h3><a href="{{$article->path()}}">{{$article->title}}</a></h3>
                    @if($article->updated_at != $article->created_at)
                        <p>updated at: {{$article->updated_at}}</p>
                    @endif
                    <p>by {{$article->author->name}} on {{$article->created_at}} in
                        @foreach($article->tags as $tag)
                            <a href="{{route('tags.show', $tag->slug)}}"><span class="badge badge-primary">{{$tag->name}}</span></a>
                        @endforeach
                    </p>
                </div>
                <div class="card-body">{{ $article->getExcerpt()  }}</div>
            </article>

        </div>

        @endforeach

    </div>


@endsection

@section('sidebar')
    @widget('LatestArticleWidget')
    @widget('TagsWidget')
@endsection
