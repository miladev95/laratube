<?php

namespace App\Http\Controllers;

use App\Events\VideoUploaded;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function upload()
    {
        return view('upload');
    }
    public function videos()
    {
        $videos = Video::all();
        return view('videos',compact('videos'));
    }


}
