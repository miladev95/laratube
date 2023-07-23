<?php

namespace App\Http\Requests;

use App\Enums\VideoStatus;
use Illuminate\Foundation\Http\FormRequest;

class AdminChangeVideoStatusRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'status' => ['required','in:'.VideoStatus::Pending->getStringValue(true).',' . VideoStatus::Approved->getStringValue(true) . ',' .
                        VideoStatus::Deleted->getStringValue(true) . ',' . VideoStatus::Rejected->getStringValue(true)],
        ];
    }
}
