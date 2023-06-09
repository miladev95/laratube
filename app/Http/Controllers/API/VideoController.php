<?php

namespace App\Http\Controllers\API;

use App\Events\VideoUploaded;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('video')) {
            event(new VideoUploaded(new Video(['title' => $request->title])));
            $video = $request->file('video');
            $path = $video->store('videos', 'public');
            Video::create([
                'title' => $request->title,
                'description' => $request->description,
                'src' => $path,
                'user_id' => 1,
            ]);
            return response()->json([
                'message' => 'Video uploaded successfully',
                'path' => $path,
            ]);
        } else {
            return response()->json(['message' => 'No video file provided']);
        }
    }
}
