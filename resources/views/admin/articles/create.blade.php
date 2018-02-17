@extends('layouts.admin')

@section('title',  'New Article')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>New Article</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('admin.articles.store')}}">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content" rows="7"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection
