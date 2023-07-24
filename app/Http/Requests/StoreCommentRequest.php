<?php

namespace App\Http\Requests;

class StoreCommentRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'body' => 'required|string',
        ];
    }
}
