<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Response;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use Response;
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('YourAppToken')->accessToken;
            return $this->successResponse(message: 'Successfully logged in',data: ['token' => $token]);
        } else {
            return $this->errorResponse(message: 'Unauthorized',code: 401);
        }
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('laratube')->accessToken;
        return $this->successResponse(data: ['token' => $token],code: 201);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens->each(function ($token) {
            $token->delete();
        });
        return $this->successResponse(message: 'Logged out successfully');
    }
}
