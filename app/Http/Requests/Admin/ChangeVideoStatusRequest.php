<?php

namespace App\Http\Requests\Admin;

use App\Enums\VideoStatus;
use App\Http\Requests\BaseRequest;

class ChangeVideoStatusRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'status' => ['required','in:'.VideoStatus::Pending->getStringValue(true).',' . VideoStatus::Approved->getStringValue(true) . ',' .
                        VideoStatus::Deleted->getStringValue(true) . ',' . VideoStatus::Rejected->getStringValue(true)],
        ];
    }
}
