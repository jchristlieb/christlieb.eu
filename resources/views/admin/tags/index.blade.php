@extends('layouts.admin')

@section('title',  'Tags')

@section('content')

    <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">Tags</h1>
    <table class="mb-4">
        <thead>
        <tr>
            <th class="text-left">Name</th>
            <th width="150px">Article Count</th>
            <th width="100px">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td><a href="{{route('admin.tags.show', $tag->id)}}">{{$tag->name}}</a></td>
                <td class="text-center">{{$tag->articles_count}}</td>
                <td class="text-center">...</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="card-body">
        {{$tags->links()}}
    </div>

@endsection
