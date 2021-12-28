<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\Http\JsonResponseHelper as JsonResponse;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;

final class ErrorController
{
    final public function exception(FlattenException $exception): Response
    {
        return JsonResponse::fail(message: $exception->getMessage(), status: $exception->getStatusCode());
    }
}
