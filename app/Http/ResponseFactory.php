<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory as BaseResponseFactory;

class ResponseFactory extends BaseResponseFactory
{
    private const array HEADERS = [
        'Content-Type' => 'application/json;charset=UTF-8',
        'Charset' => 'utf-8',
    ];

    public function success(
        array | AnonymousResourceCollection | JsonResource | Collection $data = [], 
        string $message = 'ok', 
        int $statusCode = Response::HTTP_OK): JsonResponse
    {
        if ($data instanceof JsonResource || $data instanceof AnonymousResourceCollection) {
            $data = $data->resolve();
        }

        if ($data instanceof Collection || $data instanceof JsonResource) {
            $data = $data->toArray();
        }

        return $this->json(
            ['status_code' => $statusCode, 'message' => $message, "data" => $data],
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
