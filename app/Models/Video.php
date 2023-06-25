<?php

namespace App\Models;

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
}
