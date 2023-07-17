<?php

namespace App\Http\Controllers\Admin;

use App\Enums\VideoStatus;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::pending()->get();
        return view('admin.videos', compact('videos'));
    }

    public function changeStatus(Request $request, Video $video)
    {
        $video->status = $request->status;
        return view('admin.videos')->with('success', 'Video status successfully changed');
    }

    public function approve(Video $video)
    {
        $video->status = VideoStatus::Approved->getStringValue();
        $video->save();
        return back()->with('success', 'Video approved successfully');
    }

    public function reject(Request $request)
    {
        $video_id = $request->input('video_id');
        $video = Video::whereId($video_id)->first();
        if ($video) {
            $video->status = VideoStatus::Rejected->getStringValue();
            $video->reject_reason = $request->input('reason');
            $video->save();
            return back()->with('success', 'Video rejected successfully');
        } else {
            return back()->with('error', 'Something is wrong');
        }

    }
}
