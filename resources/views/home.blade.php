@php use App\Models\Video; @endphp
@extends('base')


@section('title', 'Video List')

@section('content')
    @forelse($videos as $video)
        <x-video-list-item :video="$video" />
    @empty
        <p class="text-muted p-3 text-center fs-5">No videos found.</p>
    @endforelse

@endsection
