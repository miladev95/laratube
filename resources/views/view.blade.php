@extends('base')


@section('title', 'View')

@section('style')
    <style>
        .fullscreen-iframe {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio (height / width) */
            height: 0;
        }

        .fullscreen-iframe iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h2>View</h2>
        </div>
        <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{$video->src}}" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
