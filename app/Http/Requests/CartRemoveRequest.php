<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRemoveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|uuid'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Id is required',
            'id.uuid' => 'Id must be a valid uuid'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
