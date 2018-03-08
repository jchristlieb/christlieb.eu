@extends('layouts.admin')

@section('title',  'Media')

@section('content')
    <profile user-data="{{auth()->user()}}"></profile>
@endsection
