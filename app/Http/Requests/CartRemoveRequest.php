<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRemoveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'productId' => 'required|int|exists:products,id'
        ];
    }

    public function messages(): array
    {
        return [
            'productId.required' => 'Product ID is required',
            'productId.int' => 'Product ID must be an integer',
            'productId.exists' => 'Product ID must exist in the database'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
