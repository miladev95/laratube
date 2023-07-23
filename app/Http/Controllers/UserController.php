<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Response;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use Response;
    public function show()
    {
        $user = Auth::user();
        return $this->successResponse(data: $user);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $name = $request->name;
        $password = Hash::make($request->password);
        $current_password = $request->current_password;

        // user entered correct current password
        if (Hash::check($current_password, $user->password)) {
            $user->update([
                'name' => $name,
                'password' => $password,
            ]);
            return $this->successResponse(message: 'Profile updated');
        } else {
            return $this->errorResponse(message: 'Invalid password');
        }
    }
}
