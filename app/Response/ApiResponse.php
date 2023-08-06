<?php

namespace App\Response;

use GuzzleHttp\Psr7\Response;

// Abstract class or interface defining the Factory Method
abstract class ResponseFactory
{
    abstract public static function toJson(string $message, int $statusCode, bool $status, $data): Response;
}

class ApiResponse extends ResponseFactory
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
