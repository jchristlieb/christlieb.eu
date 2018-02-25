@extends('layouts.admin')

@section('title',  'Media')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Images</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($images as $image)
                    <div class="col-sm-3 mb-3">
                        <img src="{{Storage::url($image->path)}}" alt="{{$image->alt}}"/>
                    </div>
                @empty
                    <p class="text-center">No Images defined!</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection
