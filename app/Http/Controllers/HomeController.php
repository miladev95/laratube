<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Response;
use App\Http\Resources\VideosResource as UserVideoResource;
use App\Models\Video;

class HomeController extends Controller
{
    use Response;
    public function index()
    {
        $videos = Video::Approved()->get();
        $videoResource = UserVideoResource::collection($videos);
        return $this->successResponse(data: $videoResource);
    }
}
