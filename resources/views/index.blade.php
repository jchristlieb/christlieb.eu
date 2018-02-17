@extends('layouts.app')

@section('title',  'Welcome')
@section('content')

@endsection

@section('sidebar')
    @widget('LatestArticleWidget')
    @widget('TagsWidget')
@endsection
