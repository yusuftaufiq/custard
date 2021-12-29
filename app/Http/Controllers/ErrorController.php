<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ErrorController
{
    final public function exception(FlattenException $exception): Response
    {
        return new JsonResponse([
            'status' => $exception->getStatusText(),
            'message' => $exception->getMessage(),
            'data' => (object) [],
        ], $exception->getStatusCode());
    }
}
