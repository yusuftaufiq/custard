<?php

namespace App\Listeners;

use App\Helpers\Http\JsonResponseHelper as JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundListener
{
    public function handler(NotFoundHttpException $exception): Response
    {
        return JsonResponse::fail(message: $exception->getMessage(), status: Response::HTTP_NOT_FOUND);
    }
}
