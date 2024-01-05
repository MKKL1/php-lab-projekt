<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|uuid',
            'productId' => 'exists:products,id',
            'quantity' => 'int|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Id is required',
            'id.uuid' => 'Id must be a valid uuid',
            'productId.exists' => 'Product does not exist',
            'quantity.int' => 'Quantity must be an integer',
            'quantity.min' => 'Quantity must be at least 1'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
