@extends('layouts.app')

@section('content')

    @forelse($articles as $article)
        <article class="card">
            <div class="card-header">
                <h3>{{$article->title}}</h3>
            </div>
            <div class="card-body">
                {{$article->content}}
            </div>
        </article>
    @empty
<h2 class="text-center">There are no Articles!</h2>
    @endforelse
@endsection
