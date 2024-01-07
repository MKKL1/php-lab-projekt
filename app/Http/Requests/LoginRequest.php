<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws BindingResolutionException
     */
    public function getCredentials(): array
    {

        $username = $this->get('username');

        if ($this->isEmail($username)) {
            return [
                'email' => $username,
                'password' => $this->get('password')
            ];
        }

        return $this->only('username', 'password');
    }

    /**
     * @throws BindingResolutionException
     */
    private function isEmail($param): bool
    {
        $factory = $this->container->make(ValidationFactory::class);

        return ! $factory->make(
            ['username' => $param],
            ['username' => 'email']
        )->fails();
    }
}
