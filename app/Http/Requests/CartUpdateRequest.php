<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'items' => ['array'],
            'items.*.productId' => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1']
        ];
    }

    public function messages(): array
    {
        return [
            'items.*.productId.required' => 'Product ID is required',
            'items.*.productId.integer' => 'Product ID must be an integer',
            'items.*.productId.exists' => 'Product ID must exist in the database',
            'items.*.quantity.required' => 'Quantity is required',
            'items.*.quantity.integer' => 'Quantity must be an integer',
            'items.*.quantity.min' => 'Quantity must be at least 1'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
