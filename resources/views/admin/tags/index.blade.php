@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Tags</h3>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th width="150px">Article Count</th>
                <th width="100px">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td><a href="{{route('admin.tags.show', $tag->id)}}">{{$tag->name}}</a></td>
                    <td>{{$tag->articles_count}}</td>
                    <td>...</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="card-body">
            {{$tags->links()}}
        </div>
    </div>

@endsection
