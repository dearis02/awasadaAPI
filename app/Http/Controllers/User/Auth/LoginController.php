<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $validated = validator($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!auth()->attempt($validated)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $validated['email'])->firstOrFail();

        $payload = [
            'iss' => config('app.name'),
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24 * 7
        ];

        $key = config('app.jwt_secret_key');

        $token = JWT::encode($payload, $key, 'HS256');

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Login success',
            'token' => $token
        ]);
    }
}
