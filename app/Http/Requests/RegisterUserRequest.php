<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'min:3', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Login is required',
            'login.string' => 'Login must be a string',
            'login.min' => 'Login must be at least 3 characters',
            'login.max' => 'Login must be less than 255 characters',
            'login.unique' => 'Login must be unique',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password must be less than 255 characters',
            'email.required' => 'Email is required',
            'email.string' => 'Email must be a string',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must be less than 255 characters',
            'email.unique' => 'Email must be unique',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
