<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends BaseRequest
{
    public function rules(): array
    {
        return  [
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'video' => 'required', // Adjust the mimetypes and max size as per your requirements
        ];
    }
}
