<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use App\Http\Helpers\JWT;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserPostRequest;
use App\Http\Resources\RegisterResource;

class RegisterController extends Controller
{
    public function register(RegisterUserPostRequest $req)
    {
        $validated = $req->validated();

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = JWT::encode($user->id);

        return (new RegisterResource($token))
            ->response()
            ->setStatusCode(201);
    }
}
