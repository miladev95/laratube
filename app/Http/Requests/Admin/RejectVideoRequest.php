<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;

class RejectVideoRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'reason' => 'required|min:3'
        ];
    }
}
