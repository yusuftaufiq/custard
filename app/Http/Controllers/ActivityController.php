<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\Http\JsonResponseHelper as JsonResponse;
use App\Models\Activity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ActivityController
{
    final public function index(Request $request): Response
    {
        return JsonResponse::success(Activity::init()->all())
            ->prepare($request);
    }

    final public function show(Request $request, int $id): Response
    {
        return JsonResponse::success(Activity::init()->find($id))
            ->prepare($request);
    }
}
