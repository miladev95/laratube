<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'password' => 'required|min:3|confirmed',
            'current_password' => 'required|min:3',
        ];
    }
}
