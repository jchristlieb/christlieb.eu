@extends('layouts.admin')

@section('title',  'Media')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Images</h3>
        </div>
        <div class="card-body">
            <div class="flex flex-wrap">
                @forelse($images as $image)
                    <div class="w-1/4">
                        <img src="{{Storage::url($image->path)}}" alt="{{$image->alt}}"/>
                    </div>
                @empty
                    <p class="text-center">No Images defined!</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection
