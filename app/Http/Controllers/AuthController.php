<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function registerUser(RegisterUserRequest $request) {
        $data = $request->validated();
        $user = User::create([
            'username' => $data['login'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $res = $user->save();
        if ($res) {
            return back()->with('success', 'User created successfully');
        }
        return back()->with('fail', 'User creation failed');
    }
}
