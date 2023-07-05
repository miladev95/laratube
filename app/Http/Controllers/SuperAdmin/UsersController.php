<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Role;
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

    public function assignUser(User $user)
    {
        $userRole= Role::where(['name' => 'user'])->first();
        $user->assignRole($userRole);

        return back()->with('success','Role successfully assigned');
    }

    public function assignAdmin(User $user)
    {
        $adminRole= Role::where(['name' => 'admin'])->first();
        $user->assignRole($adminRole);

        return back()->with('success','Role successfully assigned');
    }

    public function assignSuperAdmin(User $user)
    {
        $superAdminRole= Role::where(['name' => 'super_admin'])->first();
        $user->assignRole($superAdminRole);

        return back()->with('success','Role successfully assigned');
    }
}
