@extends('layouts.app')

@section('title',  'Welcome')
@section('content')

    <main class="flex flex-wrap -mx-4">
        @foreach($promotedArticles as $article)

            <div class="mb-4 px-4{{ $loop->first ?' w-full' : ' w-1/2' }}">

                <article class="relative">
                    <header>
                        @if($article->image)
                            <img src="{{Storage::url($article->image->path)}}" class="w-full"/>
                        @endif
                        <div class="absolute pin-l pin-b w-full bg-grey-transparent p-8">
                            <h3><a class="text-grey-lightest" href="{{$article->path()}}">{{$article->title}}</a></h3>
                            @if($loop->first)
                                <p class="text-grey-light">{{$article->getExcerpt(20)}}</p>
                            @endif
                        </div>
                    </header>
                </article>

            </div>

        @endforeach

    </main>


@endsection

@section('sidebar')
    <div class="relative mb-4">
        <img class="w-full" src="http://lorempixel.com/380/260/technics/"/>
        <div class="absolute pin bg-blue opacity-75"></div>
        <div class="absolute pin text-center flex justify-center">
            <div class="self-center text-grey-lightest text-5xl bold">Laravel<p class="text-base">Featured Topic</p></div>
        </div>
    </div>
    <div class="relative mb-4">
        <img class="w-full" src="http://lorempixel.com/380/260/technics/"/>
        <div class="absolute pin bg-red opacity-75"></div>
        <div class="absolute pin text-center flex justify-center">
            <div class="self-center text-grey-lightest text-5xl bold">PHP<p class="text-base">Featured Topic</p></div>
        </div>
    </div>
@endsection
