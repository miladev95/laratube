@extends('base')

@section('title', 'Video Edit')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card mt-4">
        <div class="card-header">
            <h2>Video Update</h2>
        </div>
        <div class="card-body">
            <form action="{{route('video.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="video">Video</label>
                    <input type="file" class="form-control-file" id="video"  name="video">
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <iframe width="100%" height="auto" src="{{$video->src}}" frameborder="0"
                                allowfullscreen></iframe>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$video->title}}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" >{{ $video->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
