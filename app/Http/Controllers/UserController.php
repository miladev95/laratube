<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user', compact('user'));
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
            return redirect()->route('profile')->with('success', 'Profile updated');

        } else {
            return redirect()->route('profile')->with('error', 'Invalid password');
        }


    }
}
