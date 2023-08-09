<?php

namespace App\Http\Helpers;

use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key;

class JWT
{
    public static function encode($id)
    {
        $key = env('JWT_SECRET_KEY');

        $payload = [
            'iss' => config('app.name'),
            'sub' => $id,
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24 * 3 // 3 days
        ];

        return FirebaseJWT::encode($payload, $key, 'HS256');
    }

    public static function decode($token)
    {
        $key = env('JWT_SECRET_KEY');

        return FirebaseJWT::decode($token, new Key($key, 'HS256'));
    }
}
