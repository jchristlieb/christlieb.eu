@extends('layouts.no-sidebar')

@section('title',  'Forgot Password?')

@section('content')
    <div class="container mx-auto py-8">
        <div class="flex justify-center">
            <form class="px-8 pt-6 pb-8 mb-8 mx-auto w-1/3" method="POST"
                  action="{{ route('password.email') }}">
                <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4 text-center">Reset Password</h1>
                {{csrf_field()}}
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border border-grey-light rounded w-full py-2 px-3 text-grey-darker mb-3{{ $errors->has('email') ? ' border-red' : '' }}"
                           id="email" type="email" value="{{ old('email') }}" name="email">
                    @if ($errors->has('email'))
                        <p class="text-red text-xs italic">{{$errors->first('email')}}</p>
                    @endif
                </div>
                <div>
                    <button class=" w-full bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded"
                            type="submit">
                        Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
