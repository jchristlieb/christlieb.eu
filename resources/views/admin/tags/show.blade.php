@extends('layouts.admin')

@section('content')

    <h1>Tag: {{$tag->name}}</h1>

    @foreach($tag->articles as $article)
        <article class="card mb-5">
            <div class="card-header">
                <h3><a href="{{route('admin.tags.article.delete', [$tag->id, $article->id])}}">{{$article->title}}</a></h3>
                @if($article->updated_at != $article->created_at)
                    <p>updated at: {{$article->created_at}}</p>
                @endif
                <p>by {{$article->author->name}} on {{$article->created_at}}</p>
            </div>
            <div class="card-body">
                {{($article->getExcerpt())}}
            </div>
        </article>
    @endforeach

@endsection
