<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;

class ApiResponseService
{
    public static function error(string $message, int $statusCode, array $errors = []): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    // يمكنك إضافة دوال أخرى للنجاح أو رسائل أخرى حسب الحاجة
}
