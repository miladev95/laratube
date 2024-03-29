<?php

namespace App\Http\Requests\SuperAdmin;

use App\Http\Requests\BaseRequest;

class RemoveRoleRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role' => 'required',
        ];
    }
}
