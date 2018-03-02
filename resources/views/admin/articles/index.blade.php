@extends('layouts.admin')

@section('title',  'Articles')

@section('content')

    <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">Articles</h1>
    <table>
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
                <td><a href="{{route('admin.articles.show', $article->id)}}">{{$article->title}}</a></td>
                <td>...</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$articles->links()}}


@endsection
