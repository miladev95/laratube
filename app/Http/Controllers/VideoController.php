<?php

namespace App\Http\Controllers;

use App\Events\VideoUploaded;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function upload()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        event(new VideoUploaded(new Video(['title' => 'hello user'])));
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $path = $video->store('videos', 'public');
            return response()->json([
                'message' => 'Video uploaded successfully',
                'path' => $path,
            ]);
        } else {
            return response()->json(['message' => 'No video file provided']);
        }
    }
}
