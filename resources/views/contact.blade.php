@extends('layouts.no-sidebar')

@section('title',  'Legal Notice')
@section('content')

    <div class="container py-4 mx-auto">

        <div class="flex -mx-2">
            <main class="p-3 w-2/3 mx-auto">
                <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4 text-center">Contact</h1>
                <form method="POST" action="{{route('contact.store')}}">
                    {{csrf_field()}}
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="name">
                            Email
                        </label>
                        <input class="shadow appearance-none border border-grey-light rounded w-full py-2 px-3 text-grey-darker mb-3{{ $errors->has('name') ? ' border-red' : '' }}"
                               id="name" type="text" placeholder="name" value="{{ old('name') }}" name="name">
                        @if ($errors->has('name'))
                            <p class="text-red text-xs italic">{{$errors->first('name')}}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input class="shadow appearance-none border border-grey-light rounded w-full py-2 px-3 text-grey-darker mb-3{{ $errors->has('email') ? ' border-red' : '' }}"
                               id="email" type="text" placeholder="email" value="{{ old('email') }}" name="email">
                        @if ($errors->has('email'))
                            <p class="text-red text-xs italic">{{$errors->first('email')}}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="message">
                            Email
                        </label>
                        <textarea rows="7" class="shadow appearance-none border border-grey-light rounded w-full py-2 px-3 text-grey-darker mb-3{{ $errors->has('message') ? ' border-red' : '' }}"
                                  id="message" type="text" name="message">{{ old('message') }}</textarea>
                        @if ($errors->has('message'))
                            <p class="text-red text-xs italic">{{$errors->first('message')}}</p>
                        @endif
                    </div>
                    <div class="flex">
                        <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="submit">
                            Send
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>


@endsection
