<?php

namespace App\Http\Controllers;

use App\Enums\VideoStatus;
use App\Events\VideoUploaded;
use App\Http\Controllers\Traits\Response;
use App\Http\Requests\SuperAdmin\StoreVideoRequest;
use App\Http\Resources\User\VideosResource as UserVideoResource;
use App\Jobs\NotifyAdminUsersForNewVideoJob;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class VideoController extends Controller
{
    use Response;

    /**
     * upload video
     */
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
            return $this->errorResponse(message: 'No video file provided', code: 422);
        }
    }

    public function update(Video $video, Request $request)
    {
        $this->authorize('update', $video);


        $video->title = $request->title;
        $video->status = VideoStatus::Deleted->getStringValue();
        $video->description = $request->description;
        $video->save();

        return $this->successResponse(message: 'Video updated successfully');
    }

    /**
     * remove a video
     */
    public function remove(Video $video)
    {
        $this->authorize('remove', $video);

        $video->status = VideoStatus::Deleted->getStringValue();
        $video->save();
        return $this->successResponse(message: 'Video removed successfully');
    }

    public function videos()
    {
        $videos = Video::where('user_id', Auth::user()->id)->where('status','<>','Deleted')->get();
        $videoResource = UserVideoResource::collection($videos);
        return $this->successResponse(data: $videoResource);
    }

    /**
     * increment view of a video
     */
    public function view(Video $video)
    {
        if($video->status === 'Deleted') {
            return $this->errorResponse(message: 'Video not found');
        }
        $video->incrementViews();
        $video->save();
        return $this->successResponse(message: 'Success');
    }

    /**
     *  Show like counts of a video
     */
    public function showLikes(Video $video)
    {
        $videoWithLikesCount = Video::likesCount()->find($video->id);
        $likesCount = $videoWithLikesCount->liked_by_users_count;
        return $this->successResponse(data: $likesCount);
    }

    /**
     * Like a video
     */
    public function like(Video $video)
    {
        if ($video->likedByUsers()->where('user_id', Auth::id())->exists()) {
            return $this->errorResponse(message: 'You already liked this video',code: 422);
        }
        $video->likedByUsers()->syncWithoutDetaching(Auth::id());
        return $this->successResponse(message: 'Video Liked');
    }
}
