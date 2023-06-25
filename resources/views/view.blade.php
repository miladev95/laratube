@extends('base')


@section('title', 'View')

@section('content')
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h2>View</h2>
        </div>
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-md-6">
                    <iframe width="100%" height="auto" src="{{$video->src}}" frameborder="0"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
