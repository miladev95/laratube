@extends('admin.base')

@section('title', 'Video List')

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
                        <a class="btn btn-danger mt-2 ml-2 open-reject-modal" href="{{ route('admin.video.reject',['video' => $video]) }}">Reject</a>
                        <a href="{{ route('admin.video.approve',['video' => $video]) }}"
                           class="btn btn-success mt-2 ml-2">Approve</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted p-3 text-center fs-5">this is admin</p>

    @endforelse

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="rejectForm">
                        <input type="hidden" id="videoId" name="videoId">
                        <div class="form-group">
                            <label for="rejectReason">Reject Reason</label>
                            <input type="text" class="form-control" id="rejectReason" name="rejectReason">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="rejectSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.open-reject-modal').click(function() {
                var videoId = $(this).data('video-id');
                console.log(videoId);
                $('#videoId').val(videoId);
                $('#rejectModal').modal('show');
            });

            $('#rejectSubmit').click(function() {
                var videoId = $('#videoId').val();
                var rejectReason = $('#rejectReason').val();

                $.ajax({
                    type: 'POST',
                    url: '/admin/video/' + videoId + '/reject',
                    data: {
                        reason: rejectReason
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            });
        });




@endsection
