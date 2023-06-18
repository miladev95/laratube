<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
        return  [
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'video' => 'required', // Adjust the mimetypes and max size as per your requirements
        ];
    }

    public function messages()
    {
        return [
            'video.required' => 'Please upload a video file.',
            'video.mimetypes' => 'The uploaded file must be a valid video file.',
            'title.required' => 'Please enter title',
            'description.required' => 'Please enter description',
        ];
    }
}
