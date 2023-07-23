<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Response;
use App\Http\Resources\SuperAdmin\VideosResource;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use Response;

    public function index()
    {
        $videos = Video::all();
        $videosResource = VideosResource::collection($videos);
        return $this->successResponse(data: $videosResource);
    }
}
