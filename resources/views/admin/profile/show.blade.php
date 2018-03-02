@extends('layouts.admin')

@section('title',  'Media')

@section('content')
    <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">Profile</h1>

    <p class="mb-2 text-grey-dark">Name: {{auth()->user()->name}}</p>
    <p class="mb-2 text-grey-dark">Email: {{auth()->user()->email}}</p>
@endsection
