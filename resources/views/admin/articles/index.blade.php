@extends('layouts.admin')

@section('title',  'Articles')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Articles</h3>
        </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$article->created_at}}</td>
                        <td><a href="{{route('admin.articles.show', $article->id)}}">{{$article->title}}</a> </td>
                        <td>...</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        <div class="card-body">
            {{$articles->links()}}
        </div>
    </div>

@endsection
