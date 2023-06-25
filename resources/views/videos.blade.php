@extends('base')


@section('title', 'Video List')

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h2>Videos</h2>
            <a href="{{ route('upload') }}" class="btn btn-primary">New</a>

        </div>
        <div class="card-body">
            @foreach($videos as $video)
                <div class="row">
                    <div class="col-md-6">
                        <h4>{{$video->title}}</h4>
                        <p>{{$video->description}}</p>
                    </div>
                    <div class="col-md-6">
                        <iframe width="100%" height="auto" src="{{$video->src}}" frameborder="0"
                                allowfullscreen></iframe>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
