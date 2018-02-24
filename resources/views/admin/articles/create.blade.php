@extends('layouts.admin')

@section('title',  'New Article')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>New Article</h3>
        </div>
        <div class="card-body">
            <article-form url="{{route('admin.articles.store')}}"></article-form>
        </div>
    </div>

@endsection
