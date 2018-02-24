@extends('layouts.app')

@section('title',  'Blog')

@section('content')

    @foreach($articles as $article)
        <article class="card mb-5">
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
            <div class="card-body">
                {{($article->getExcerpt())}}
            </div>
        </article>
    @endforeach

    {{$articles->links()}}

@endsection

@section('sidebar')
    @widget('LatestArticleWidget')
@endsection
