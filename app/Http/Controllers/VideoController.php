<?php

namespace App\Http\Controllers;

use App\Enums\VideoStatus;
use App\Events\VideoUploaded;
use App\Http\Requests\StoreVideoRequest;
use App\Jobs\NotifyAdminUsersForNewVideoJob;
use App\Models\Video;
use App\Notifications\NewVideoUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class VideoController extends Controller
{
    public function upload()
    {
        return view('upload');
    }

    public function edit(Video $video)
    {
        return view('edit', compact('video'));
    }

    public function store(StoreVideoRequest $request)
    {
        if ($request->hasFile('video')) {
            event(new VideoUploaded(new Video(['title' => $request->title])));
            $video = $request->file('video');
            $path = $video->store('videos', 'public');

            $video = new Video();
            $video->id = Uuid::uuid4()->toString();
            $video->title = $request->title;
            $video->description = $request->description;
            $video->status = VideoStatus::Pending->getStringValue();
            $video->src = $path;

            $user = Auth::user();
            $user->videos()->save($video);

            NotifyAdminUsersForNewVideoJob::dispatch($user);

            return redirect()->route('user.videos.index')->with('success', 'Video uploaded successfully');
        } else {
            return redirect()->back()->with('error', 'No video file provided!');
        }
    }

    public function update(Video $video, Request $request)
    {
        $this->authorize('update', $video);


        $video->title = $request->input('title');
        $video->status = VideoStatus::Pending->getStringValue();
        $video->description = $request->input('description');

        $video->save();

        return redirect()->route('videos');
    }

    public function remove(Video $video)
    {
        $this->authorize('remove', $video);

        Storage::disk('public')->delete($video->src);
        $video->delete();
        return back();
    }

    public function videos()
    {
        $videos = Video::where('user_id', Auth::user()->id)->get();
        return view('videos', compact('videos'));
    }

    public function view(Video $video)
    {
        $video->incrementViews();

        $video->save();

        return view('view', compact('video'));
    }
}
