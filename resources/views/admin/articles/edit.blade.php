@extends('layouts.admin')

@section('title',  'New Article')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Edit Article</h3>
        </div>
        <div class="card-body">
            @include('partials.form-errors')
            <form method="POST" action="{{route('admin.articles.update', $article->id)}}">
                {{csrf_field()}}
                {{method_field('patch')}}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" value="{{$article->title}}" name="title" id="title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content" rows="7">{{$article->content}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection
