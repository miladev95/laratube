<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Response;
use App\Http\Requests\SuperAdmin\RemoveRoleRequest;
use App\Http\Resources\SuperAdmin\UsersResource;
use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    use Response;
    public function index()
    {
        $users = User::all();
        $resource = UsersResource::collection($users);
        return $this->successResponse(data: $resource);
    }

    /**
     * remove user with all videos and roles
     */
    public function remove(User $user)
    {
        $user->roles()->detach(); // Remove related role_user records
        $user->videos()->delete();
        $user->delete(); // Delete the user record
        return $this->successResponse(message: "User $user->name successfully removed");
    }

    /**
     * assign user role to a user
     */
    public function assignUser(User $user)
    {
        $userRole = Role::where(['name' => 'user'])->first();
        $user->assignRole($userRole);
        return $this->successResponse(message: 'Successfully assigned');
    }

    /**
     * assign admin role to a user
     */
    public function assignAdmin(User $user)
    {
        $adminRole = Role::where(['name' => 'admin'])->first();
        $user->assignRole($adminRole);
        return $this->successResponse(message: 'Successfully assigned');
    }

    /**
     * assign super admin role to a user
     */
    public function assignSuperAdmin(User $user)
    {
        $superAdminRole = Role::where(['name' => 'super_admin'])->first();
        $user->assignRole($superAdminRole);
        return $this->successResponse(message: 'Successfully assigned');
    }


    /**
     * remove a role from user
     */
    public function removeRole(RemoveRoleRequest $request , User $user)
    {
        $role = $request->role;
        $role = str_replace(' ', '_', $role);
        $roleModel = Role::where('name', $role)->first(); // Assuming 'name' is the column storing role names
        $user->removeRole($roleModel->id);
        return $this->successResponse(message: 'Successfully removed');
    }
}
