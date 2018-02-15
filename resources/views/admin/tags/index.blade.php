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
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{$tag->name}}</td>
                    <td width="100px">...</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="card-body">
            {{$tags->links()}}
        </div>
    </div>

@endsection
