<?php

namespace App\Http\Controllers;

use App\Enums\CommentStatus;
use App\Enums\VideoStatus;
use App\Http\Controllers\Traits\Response;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    use Response;
    /**
     * comment by a user on a video
     */
    public function store(StoreCommentRequest $request, Video $video)
    {
        $comment = new Comment([
            'body' => $request->body,
        ]);
        $comment->user_id = Auth::id();
        $comment->video_id = $video->id;
        $comment->save();

        return $this->successResponse(message: 'Your comment has been saved');
    }
}
