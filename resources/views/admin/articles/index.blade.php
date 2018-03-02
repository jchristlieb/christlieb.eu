@extends('layouts.admin')

@section('title',  'Articles')

@section('content')

    <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">Articles</h1>
    <table>
        <thead>
        <tr>
            <th>Created</th>
            <th>Published</th>
            <th>Title</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{$article->created_at->formatLocalized('%B %d,  %Y')}}</td>
                <td>
                    @if($article->is_published)
                        {{$article->published_at->formatLocalized('%B %d,  %Y')}}
                    @endif
                </td>
                <td><a href="{{route('admin.articles.show', $article->id)}}">{{$article->title}}</a></td>
                <td><a href="{{route('admin.articles.edit', $article->id)}}" class="btn">Edit</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$articles->links()}}


@endsection
