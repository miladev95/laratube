<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeConvertRole($role)
    {
        if ($role === 'Super Admin') {
            return 'super_admin';
        }

        if ($role === 'Admin') {
            return 'admin';
        }

        if ($role === 'User') {
            return 'user';
        }
    }
}
