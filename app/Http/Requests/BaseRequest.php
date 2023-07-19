<?php

namespace App\Http\Requests;

use App\Http\Controllers\Traits\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    use Response;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        return $this->errorResponse(message: 'The given data was invalid', code: 422, data: $validator->errors());
    }
}
