<?php

namespace App\Http\Resources\User;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $videoWithLikesCount = Video::likesCount()->find($this->id);
        $likesCount = $videoWithLikesCount->liked_by_users_count;
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'likes' => $likesCount,
            'url' => $this->src,
            'status' => $this->status,
            'user' => $this->user->email,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
