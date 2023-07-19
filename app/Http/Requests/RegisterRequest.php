<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:3',
            'password_confirmation' => 'same:password',
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
