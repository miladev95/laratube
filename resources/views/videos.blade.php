@extends('base')


@section('title', 'Video List')

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h2>Videos</h2>
            <a href="{{ route('upload') }}" class="btn btn-primary">New</a>

        </div>
        <div class="card-body">
            @forelse($videos as $video)
                <div class="row mt-2">
                    <div class="col-md-6">
                        <h4>Title: {{$video->title}}</h4>
                        <p>Description: {{$video->description}}</p>
                        <p>Source: {{$video->src}}</p>
                        <p>Views: {{$video->view}}</p>
                        <p>Status: {{$video->status}}</p>
                    </div>
                    <div class="col-md-6">
                        <iframe width="100%" height="auto" src="{{$video->src}}" frameborder="0"
                                allowfullscreen></iframe>
                    </div>
                    <div class="col-md-12 d-flex">
                        <a href="{{ route('remove',['video' => $video]) }}" class="btn btn-primary mt-2"
                           onclick="return confirm('Are you sure you want to remove this video?')">Remove</a>
                        <a href="{{ route('edit',['video' => $video]) }}" class="btn btn-primary mt-2 ml-2">Edit</a>
                        <a href="{{ route('view',['video' => $video]) }}" class="btn btn-primary mt-2 ml-2">View</a>
                    </div>
                </div>
            @empty
                <p class="text-muted p-3 text-center fs-5">No videos found.</p>
            @endforelse
        </div>
    </div>
@endsection
