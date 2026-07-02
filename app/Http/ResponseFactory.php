<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory as BaseResponseFactory;

class ResponseFactory extends BaseResponseFactory
{
    private const array HEADERS = [
        'Content-Type' => 'application/json;charset=UTF-8',
        'Charset' => 'utf-8',
    ];

    public function success(array $data = [], string $message = 'ok', int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return $this->json(
            ['status_code' => $statusCode, 'message' => $message, ...$data],
            $statusCode,
            self::HEADERS,
            JSON_UNESCAPED_UNICODE
        );
    }

    public function error(string $message, array $errors = [], int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return $this->json(
            ['status_code' => $statusCode, 'message' => $message, 'errors' => $errors],
            $statusCode,
            self::HEADERS,
            JSON_UNESCAPED_UNICODE
        );
    }
}
