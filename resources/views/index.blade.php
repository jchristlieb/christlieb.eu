@extends('layouts.app')

@section('title',  'Welcome')
@section('content')
    <main class="px-4">
        <div class="flex flex-wrap -mx-4">
            @foreach($promotedArticles as $article)

                <div class="mb-4 px-4 w-full{{ $loop->first ?'' : ' md:w-1/2' }}">

                    <article class="relative overflow-hidden">
                        @if($article->image)
                            <img src="{{Storage::url($article->image->path)}}" class="w-full block"/>
                        @endif
                        <div class="absolute pin-l pin-b w-full bg-grey-transparent p-8">
                            @if($loop->first)
                                <h2><a class="text-4xl text-grey-lightest font-condensed"
                                       href="{{$article->path()}}">{{$article->title}}</a>
                                </h2>
                                <p class="text-grey-light font-serif hidden md:block">{{$article->getExcerpt(20)}}</p>
                            @else
                                <h3>
                                    <a class="text-2xl text-grey-lightest font-condensed"
                                       href="{{$article->path()}}">{{$article->title}}</a>
                                </h3>
                            @endif
                        </div>
                    </article>

                </div>

            @endforeach

        </div>
    </main>

@endsection

@section('sidebar')
    <div class="px-4">
        @foreach($tags as $tag)
            <div class="relative mb-4">
                <a href="/tags/{{$tag->slug}}">
                    @if($tag->image)
                        <img class="w-full block"
                             src="{{Storage::url($tag->image->path)}}"/>
                    @else
                        <img class="w-full block" src="https://lorempixel.com/400/200"/>
                    @endif
                    <div class="absolute pin bg-blue-transparent"></div>
                    <div class="absolute pin text-center flex justify-center">
                        <div class="self-center text-grey-lightest text-5xl font-condensed font-bold">{{$tag->name}}<p
                                    class="text-base">
                                Featured Topic</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
