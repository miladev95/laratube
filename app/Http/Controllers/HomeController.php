<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Response;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Response;
    public function index()
    {
        $videos = Video::Approved()->get();
        return $this->successResponse(data: $videos);
    }
}
