@extends('layouts.admin')

@section('content')
    <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">System Info</h1>

    <table>
        <thead>
        <tr>
            <td>Name</td>
            <td>Value</td>
        </tr>
        </thead>
        <tbody>
        @foreach($systemInfos as $key => $value)
            <tr>
                <td>{{$key}}</td>
                <td>{{$value}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
