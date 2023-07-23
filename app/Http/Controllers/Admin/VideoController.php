<?php

namespace App\Http\Controllers\Admin;

use App\Enums\VideoStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Response;
use App\Http\Requests\Admin\ChangeVideoStatusRequest;
use App\Http\Requests\Admin\RejectVideoRequest;
use App\Http\Resources\AdminVideosResource;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use Response;

    public function index()
    {
        $videos = Video::pending()->get();
        $videoResource = AdminVideosResource::collection($videos);
        return $this->successResponse(data: $videoResource);
    }

    public function changeStatus(ChangeVideoStatusRequest $request, Video $video)
    {
        $video->status = $request->status;
        $video->save();
        return $this->successResponse(message: 'Video status successfully changed');
    }

    public function approve(Video $video)
    {
        $video->status = VideoStatus::Approved->getStringValue();
        $video->save();
        return $this->successResponse(message: 'Video approved successfully');
    }

    public function reject(Video $video, RejectVideoRequest $request)
    {
        $video->status = VideoStatus::Rejected->getStringValue();
        $video->reject_reason = $request->reason;
        $video->save();
        return $this->successResponse(message: 'Video rejected successfully');
    }
}
