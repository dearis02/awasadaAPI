<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class API
{
    public static function notFoundResponse($message): JsonResponse
    {
        return response()->json([
            'status' => 404,
            'success' => false,
            'message' => $message
        ], 404);
    }

    public static function successResponse($httpStatusCode, $message, $data = null): JsonResponse
    {
        return response()->json([
            'status' => $httpStatusCode,
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $httpStatusCode);
    }

    public static function failResponse($httpStatusCode, $message, $data = null): JsonResponse
    {
        return response()->json([
            'status' => $httpStatusCode,
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $httpStatusCode);
    }
}
