<div class="card mt-4">
    <div class="card-body">
        <div class="row mt-2">
            <div class="col-md-6">
                <h4>Title: {{$video->title}}</h4>
                <p>Description: {{$video->description}}</p>
                <p>Source: {{$video->src}}</p>
                <p>Views: {{$video->view}}</p>
                <p>Status: {{$video->status}}</p>
                @if($video->status === 'Rejected' && $video->reject_reason)
                    <p>Reason: {{$video->reject_reason}}</p>
                @endif

                <div class="d-flex">
                    <a href="{{ route('remove',['video' => $video]) }}" class="btn btn-primary mt-2"
                       onclick="return confirm('Are you sure you want to remove this video?')">Remove</a>
                    <a href="{{ route('edit',['video' => $video]) }}" class="btn btn-primary mt-2 ml-2">Edit</a>
                    <a href="{{ route('view',['video' => $video]) }}" class="btn btn-primary mt-2 ml-2">View</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="video-container">
                    <iframe width="100%" height="300" src="{{$video->src}}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
