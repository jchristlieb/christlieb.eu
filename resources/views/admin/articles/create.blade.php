@extends('layouts.admin')

@section('title',  'New Article')

@section('content')


    <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">New Article</h1>

    <article-form url="{{route('admin.articles.store')}}"></article-form>

@endsection
