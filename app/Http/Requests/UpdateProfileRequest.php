<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'password' => 'required|min:3|confirmed',
            'current_password' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
            'name.min' => 'Name is not valid',
            'password.required' => 'Please enter password',
            'password.min' => 'Password is not valid',
            'password.confirmed' => 'Match the password and confirm',
            'current_password.min' => 'Current password is not valid',
            'current_password.required' => 'Please enter your current password',
        ];
    }
}
