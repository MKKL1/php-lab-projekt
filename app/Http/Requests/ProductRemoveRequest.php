<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRemoveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Id is required',
            'id.integer' => 'Id must be an integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
