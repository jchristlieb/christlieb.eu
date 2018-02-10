@extends('layouts.app')

@section('content')

        <article class="card">
            <div class="card-header">
                <h3>{{$article->title}}</h3>
            </div>
            <div class="card-body">
                {{$article->content}}
            </div>
        </article>

@endsection
