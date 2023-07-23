<?php

namespace App\Http\Controllers;

use App\Enums\VideoStatus;
use App\Events\VideoUploaded;
use App\Http\Controllers\Traits\Response;
use App\Http\Requests\SuperAdmin\StoreVideoRequest;
use App\Jobs\NotifyAdminUsersForNewVideoJob;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class VideoController extends Controller
{
    use Response;

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

            return $this->successResponse(message: 'Video uploaded successfully');
        } else {
            return $this->errorResponse(message: 'No video fille provided', code: 422);
        }
    }

    public function update(Video $video, Request $request)
    {
        $this->authorize('update', $video);


        $video->title = $request->input('title');
        $video->status = VideoStatus::Pending->getStringValue();
        $video->description = $request->input('description');

        $video->save();

        return $this->successResponse(message: 'Video updated successfully');
    }

    public function remove(Video $video)
    {
        $this->authorize('remove', $video);

        Storage::disk('public')->delete($video->src);
        $video->delete();

        return $this->successResponse(message: 'Video removed successfully');
    }

    public function videos()
    {
        $videos = Video::where('user_id', Auth::user()->id)->get();
        return $this->successResponse(data: $videos);
    }

    public function view(Video $video)
    {
        $video->incrementViews();
        $video->save();
        return $this->successResponse(data: $video);
    }
}
