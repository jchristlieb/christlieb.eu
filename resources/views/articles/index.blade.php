@extends('layouts.app')

@section('content')

    @foreach($articles as $article)
        <article class="card mb-5">
            <div class="card-header">
                <h3><a href="{{$article->path()}}">{{$article->title}}</a></h3>
            </div>
            <div class="card-body">
                {{$article->content}}
            </div>
        </article>
    @endforeach

    {{$articles->links()}}

@endsection
