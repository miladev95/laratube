<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignRole($role)
    {
        $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        $this->roles()->detach($role);
    }

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }

    public function isAdmin()
    {
        return $this->roles->contains('name', 'admin');
    }

    public function isUser()
    {
        return $this->roles->contains('name', 'user');
    }

    public function isSuperAdmin()
    {
        return $this->roles->contains('name', 'super_admin');
    }

    public function scopeshowRoles()
    {
        $result = [];
        if ($this->roles->contains('name', 'user')) {
            $result[] = 'User';
        }

        if ($this->roles->contains('name', 'admin')) {
            $result[] = 'Admin';
        }

        if ($this->roles->contains('name', 'super_admin')) {
            $result[] = 'Super Admin';
        }

        return $result;
    }

    public function likedVideos()
    {
        return $this->belongsToMany(Video::class,'likes');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
