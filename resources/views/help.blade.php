@extends('base')


@section('title','Help')


@section('content')
    <div class="card mt-4">
        <div class="card-header">
            <h2>List of URLs:</h2>
        </div>
        <ul class="list-group">
            @foreach($routes as $title => $route)
                <li class="list-group-item">{{$title }} => {{ $route }}</li>
            @endforeach
        </ul>

        @auth
            <p>Welcome, {{ Auth::user()->name }}</p>
        @else
            <p>Please login to access this page.</p>
        @endauth
    </div>
@endsection
