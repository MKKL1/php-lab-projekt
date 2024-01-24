<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'name' => ['required'],
            'cost' => ['required', 'numeric', 'min:0'],
            'saleCost' => ['nullable', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['nullable'],
            'image' => ['nullable', 'image', 'max:4096'],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Id is required',
            'id.integer' => 'Id must be an integer',
            'name.required' => 'Name is required',
            'cost.required' => 'Cost is required',
            'cost.numeric' => 'Cost must be a number',
            'cost.min' => 'Cost must be at least 0',
            'saleCost.numeric' => 'Sale cost must be a number',
            'saleCost.min' => 'Sale cost must be at least 0',
            'quantity.required' => 'Quantity is required',
            'quantity.integer' => 'Quantity must be an integer',
            'quantity.min' => 'Quantity must be at least 0',
            'image.required' => 'Image is required',
            'image.image' => 'Must be an image',
            'image.size' => 'Image size must be less than 4MB'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
