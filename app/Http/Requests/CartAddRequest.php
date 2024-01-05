<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartAddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'productId' => 'required|exists:products,id',
            'quantity' => 'required|int|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'productId.required' => 'Product is required',
            'productId.exists' => 'Product does not exist',
            'quantity.required' => 'Quantity is required',
            'quantity.int' => 'Quantity must be an integer',
            'quantity.min' => 'Quantity must be at least 1'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
