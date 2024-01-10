<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'name' => 'string',
            'description' => 'string',
            'price' => 'numeric',
            'image' => 'string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
