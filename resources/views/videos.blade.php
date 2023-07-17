@php use App\Models\Video; @endphp
@extends('base')

@section('title', 'Video List')

@section('content')

    <div class="card-header d-flex justify-content-between mt-5">
        <h2>{{count($videos)}} Videos</h2>
        <a href="{{ route('upload') }}" class="btn btn-primary">New</a>
    </div>

    @forelse($videos as $video)
        <x-video-list-item :video="$video" />
    @empty
        <p class="text-muted p-3 text-center fs-5">No videos found.</p>
    @endforelse

@endsection
