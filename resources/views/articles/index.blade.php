@extends('layouts.app')

@section('content')

    @foreach($articles as $article)
        <article class="card mb-5">
            <div class="card-header">
                <h3><a href="{{$article->path()}}">{{$article->title}}</a></h3>
                {{$article->author->name}}
            </div>
            <div class="card-body">
                {{($article->getExcerpt())}}
            </div>
        </article>
    @endforeach

    {{$articles->links()}}

@endsection
