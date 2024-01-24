<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:15',
            'lastname' => 'required|string|max:15',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|regex:/^\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{3})$/i',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
