<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\JWT;
use App\Http\Requests\LoginPostRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginPostRequest $req)
    {
        $validated = $req->validated();

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => 401,
                'success' => false,
                'message' => 'Inccorect email or password'
            ]);
        }

        $token = JWT::encode($user->id);

        return new LoginResource($token);
    }
}
