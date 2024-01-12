<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            '*.productId' => ['required', 'integer', 'exists:products,id'],
            '*.quantity' => ['required', 'integer', 'min:1']
        ];
    }

    public function messages(): array
    {
        return [
            '*.productId.required' => 'Product ID is required',
            '*.productId.integer' => 'Product ID must be an integer',
            '*.productId.exists' => 'Product ID must exist in the database',
            '*.quantity.required' => 'Quantity is required',
            '*.quantity.integer' => 'Quantity must be an integer',
            '*.quantity.min' => 'Quantity must be at least 1'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
