<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CommentStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Response;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use Response;
    /**
     * remove a comment
     */
    public function destroy(Comment $comment)
    {
        $comment->status = CommentStatus::Deleted->getStringValue();
        $comment->save();

        return $this->successResponse('Comment Deleted');
    }
}
