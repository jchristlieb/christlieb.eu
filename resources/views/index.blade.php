@extends('layouts.app')

@section('title',  'Welcome')
@section('content')

    <main class="flex flex-wrap -mx-4">
        @foreach($promotedArticles as $article)

            <div class="mb-4 px-4{{ $loop->first ?' w-full' : ' w-1/2' }}">

                <article class="relative">
                        @if($article->image)
                            <img src="{{Storage::url($article->image->path)}}" class="w-full block"/>
                        @endif
                        <div class="absolute pin-l pin-b w-full bg-grey-transparent p-8">
                            @if($loop->first)
                                <h2><a class="text-4xl text-grey-lightest font-condensed"
                                       href="{{$article->path()}}">{{$article->title}}</a>
                                </h2>
                                <p class="text-grey-light font-serif">{{$article->getExcerpt(20)}}</p>
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

    </main>


@endsection

@section('sidebar')
    <div class="relative mb-4">
        <img class="w-full block" src="http://lorempixel.com/380/260/technics/"/>
        <div class="absolute pin bg-blue-transparent"></div>
        <div class="absolute pin text-center flex justify-center">
            <div class="self-center text-grey-lightest text-5xl font-condensed font-bold">PHP<p class="text-base">
                    Featured Topic</p>
            </div>
        </div>
    </div>
    <div class="relative mb-4">
        <img class="w-full block" src="http://lorempixel.com/380/260/technics/"/>
        <div class="absolute pin bg-red-transparent opacity-75"></div>
        <div class="absolute pin text-center flex justify-center">
            <div class="self-center text-grey-lightest text-5xl font-condensed font-bold">Laravel<p class="text-base">
                    Featured Topic</p>
            </div>
        </div>
    </div>
@endsection
