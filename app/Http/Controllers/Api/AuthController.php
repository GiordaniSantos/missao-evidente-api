<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=> ['required', 'email'],
            'password' => 'required',
            'remember' => 'boolean'
        ]);

        $remember = $credentials['remember'] ?? false;

        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'message' => 'Email ou Senha incorretos'
            ], 422);
        }

        /** @var User $user */
        $user = Auth::user();

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);

    }

    public function signUp(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email'=> ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8']
        ], [
            'required' => 'O campo :attribute deve ser preenchido',
            'email.email' => 'O campo email deve ser do tipo email.',
            'email.unique' => 'O email fornecido já está sendo utilizado, informe outro email.',
            'password.min' => 'O campo senha deve ter no minimo 8 caracteres.'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response($user, 204);
    }

    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response('', 204);
    }
}
