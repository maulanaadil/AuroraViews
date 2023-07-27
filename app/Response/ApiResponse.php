<?php

namespace App\Response;

use GuzzleHttp\Psr7\Response;

class ApiResponse
{
    /**
     * Generate JSON response
     *
     * @param  mixed  $data
     */
    public static function toJson(
        string $message,
        int $statusCode,
        bool $status,
        $data
    ): Response {
        $headers = [
            'Content-Type' => 'application/json',
            'X-Powered-By' => 'Lumen',
        ];
        $payload = [
            'message' => $message,
            'statusCode' => $statusCode,
            'status' => $status,
            'data' => $data,
        ];

        return new Response($statusCode, $headers, json_encode($payload));
    }
}
