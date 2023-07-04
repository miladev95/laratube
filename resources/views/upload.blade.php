@extends('base')

@section('title', 'Video Upload')

@section('content')

    <div class="card mt-4">
        <div class="card-header">
            <h2>Video Upload</h2>
        </div>
        <div class="card-body">
            <form action="{{route('video.upload')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="video">Video</label>
                    <input type="file" class="form-control-file" id="video" name="video">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
@endsection

