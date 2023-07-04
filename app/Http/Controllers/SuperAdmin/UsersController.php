<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('superadmin.users.index',compact('users'));
    }

    public function remove(User $user)
    {
        $user->roles()->detach(); // Remove related role_user records
        $user->videos()->delete();
        $user->delete(); // Delete the user record
        return back()->with('success','User ' . $user->name . ' successfully removed');
    }
}
