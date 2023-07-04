@extends('admin.base')

@section('title', 'Video List')

@section('content')

    @if (session('success'))
        <div class="alert alert-success mt-5">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-5">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger mt-5">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @forelse($videos as $video)
        <div class="card mt-4">
            <div class="card-body">
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
                        <button class="btn btn-danger mt-2 ml-2 open-reject-modal" id="open-reject-modal"
                                data-video-id="{{$video->id}}">Reject
                        </button>
                        <a href="{{ route('admin.video.approve',['video' => $video]) }}"
                           class="btn btn-success mt-2 ml-2">Approve</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted p-3 text-center fs-5">this is admin</p>

    @endforelse

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="rejectForm" action="{{ route('admin.video.reject') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" id="videoId" name="videoId">
                        <div class="form-group">
                            <label for="rejectReason">Reject Reason</label>
                            <input type="hidden" name="video_id" id="video_id_input" >
                            <textarea type="text" class="form-control" id="rejectReason" name="reason"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="rejectCancel" data-dismiss="modal">Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" id="rejectSubmit">Reject</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <script>

        const btn = document.getElementById("open-reject-modal");
        const videoIdInput = document.getElementById("video_id_input");

        btn.addEventListener("click", function () {
            // Example: Set the modal content dynamically
            videoIdInput.value = this.getAttribute("data-video-id");
            console.log(videoIdInput.value);
        });

        $(document).ready(function () {

            $('.open-reject-modal').click(function () {
                $('#rejectModal').modal('show');
            });

            $('#rejectCancel').click(function () {
                $('#rejectModal').modal('hide');
            });
        });
    </script>

@endsection
