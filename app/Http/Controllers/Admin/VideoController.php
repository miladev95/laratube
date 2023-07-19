<?php

namespace App\Http\Controllers\Admin;

use App\Enums\VideoStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Response;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use Response;

    public function index()
    {
        $videos = Video::pending()->get();
        return $this->successResponse(data: $videos);
    }

    public function changeStatus(Request $request, Video $video)
    {
        $video->status = $request->status;
        return $this->successResponse(message: 'Video status successfully changed');
    }

    public function approve(Video $video)
    {
        $video->status = VideoStatus::Approved->getStringValue();
        $video->save();
        return $this->successResponse(message: 'Video approved successfully');
    }

    public function reject(Request $request)
    {
        $video_id = $request->input('video_id');
        $video = Video::whereId($video_id)->first();
        if ($video) {
            $video->status = VideoStatus::Rejected->getStringValue();
            $video->reject_reason = $request->input('reason');
            $video->save();
            return $this->successResponse(message: 'Video rejected successfully');
        } else {
            return $this->errorResponse(message: 'Something is wrong',code: 500);
        }

    }
}
