<?php

namespace App\Services;

class ResponseService
{
    public static function response(string $status, string $messagge, $code)
    {
        return response()->json([
            'status' => $status,
            'message' => $messagge,
        ], $code);
    }
}
