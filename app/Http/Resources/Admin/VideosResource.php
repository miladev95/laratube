<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideosResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->src,
            'status' => $this->status,
            'user' => $this->user->email,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
