@extends('layouts.admin')

@section('title',  'New Article')

@section('content')

    <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">Edit Article</h1>
@dd($article)
    <article-form url="{{route('admin.articles.update',$article->id)}}"
                  data-article="{{$article->toJson()}}"></article-form>


@endsection
