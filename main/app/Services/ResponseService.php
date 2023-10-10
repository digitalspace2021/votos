<?php

namespace App\Services;

class ResponseService
{
    public static function response(string $status, string $messagge, int $code)
    {
        return response()->json([
            'status' => $status,
            'message' => $messagge,
        ], $code);
    }
}
