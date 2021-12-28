<?php

declare(strict_types=1);

namespace App\Helpers\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class JsonResponseHelper
{
    public static function success(
        array|object $data = [],
        string $message = 'Success',
        int $status = JsonResponse::HTTP_OK,
        array $headers = [],
    ): JsonResponse {
        return new JsonResponse([
            'status' => 'Success',
            'message' => $message,
            'data' => $data,
        ], $status, $headers);
    }

    public static function fail(
        array|object $data = [],
        string $message = 'Data can\'t be retrieved',
        int $status = JsonResponse::HTTP_BAD_REQUEST,
        array $headers = [],
    ): JsonResponse {
        return new JsonResponse([
            'status' => 'Bad Request',
            'message' => $message,
            'data' => $data,
        ], $status, $headers);
    }

    public static function error(
        array|object $data = [],
        string $message = 'Internal server error, please contact the server administrator',
        int $status = JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        array $headers = [],
    ): JsonResponse {
        return new JsonResponse([
            'status' => 'Error',
            'message' => $message,
            'data' => $data,
        ], $status, $headers);
    }
}
