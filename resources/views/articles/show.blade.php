@extends('layouts.app')

@section('content')

    <article class="card">
        <div class="card-header">
            <h3>{{$article->title}}</h3>
            @if($article->updated_at != $article->created_at)
                <p>updated at: {{$article->created_at}}</p>
            @endif
            <p>by {{$article->author->name}} on {{$article->created_at}}</p>
        </div>
        <div class="card-body">
            {{$article->content}}
        </div>
    </article>

@endsection

@section('sidebar')
    @widget('LatestArticleWidget')
@endsection
