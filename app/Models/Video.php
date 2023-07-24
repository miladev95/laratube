<?php

namespace App\Models;

use App\Enums\CommentStatus;
use App\Enums\VideoStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSrcAttribute($value)
    {
        return env('VIDEO_FULL_PREFIX') . $value;
    }

    public function incrementViews()
    {
        $this->increment('view');
    }

    public function scopePending($query)
    {
        return $query->where('status', VideoStatus::Pending->getStringValue());
    }

    public function scopeApproved($query)
    {
        return $query->where('status', VideoStatus::Approved->getStringValue());
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function scopeLikesCount($query)
    {
        return $query->withCount('likedByUsers');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
