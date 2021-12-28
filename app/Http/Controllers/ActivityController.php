<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\Http\JsonResponseHelper as JsonResponse;
use App\Models\Activity;
use App\Validators\ActivityValidator;
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

    final public function store(Request $request): Response
    {
        $requestActivity = $request->toArray();

        ActivityValidator::validate()->store($requestActivity);

        $activity = Activity::init();

        $id = $activity->create($requestActivity);

        return JsonResponse::success($activity->find($id))
            ->prepare($request);
    }

    final public function update(Request $request): Response
    {
        $requestActivity = $request->toArray();

        ActivityValidator::validate()->store($requestActivity);

        return JsonResponse::success(
            data: Activity::init()->update((int) $request->get('id', 0), $requestActivity),
            status: Response::HTTP_CREATED,
        )->prepare($request);
    }

}
