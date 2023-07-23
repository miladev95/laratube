<?php

namespace App\Http\Requests;

use App\Enums\VideoStatus;
use Illuminate\Foundation\Http\FormRequest;

class AdminChangeVideoStatusRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'status' => ['required','enum:' . VideoStatus::class],
        ];
    }
}
