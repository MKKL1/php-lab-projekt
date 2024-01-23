<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsShowRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => 'nullable|int|min:1',
            'sort' => 'nullable|in:,maxcost,mincost'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
