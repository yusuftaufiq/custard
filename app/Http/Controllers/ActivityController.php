<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Validators\ActivityValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ActivityController
{
    final public function index(Request $request): JsonResponse
    {
        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'OK',
            'data' => Activity::init()->all(),
        ], JsonResponse::HTTP_OK);

        return $response->prepare($request);
    }

    final public function show(Request $request, int $id): JsonResponse
    {
        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'OK',
            'data' => Activity::init()->find($id),
        ], JsonResponse::HTTP_OK);

        return $response->prepare($request);
    }

    final public function store(Request $request): JsonResponse
    {
        $requestActivity = $request->toArray();

        ActivityValidator::validate()->store($requestActivity);

        $activity = Activity::init();

        $id = $activity->create($requestActivity);

        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'Created',
            'data' => $activity->find($id),
        ], JsonResponse::HTTP_CREATED);

        return $response->prepare($request);
    }

    final public function update(Request $request): JsonResponse
    {
        $requestActivity = $request->toArray();

        ActivityValidator::validate()->update($requestActivity);

        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'OK',
            'data' => Activity::init()->update((int) $request->get('id', 0), $requestActivity),
        ], JsonResponse::HTTP_OK);

        return $response->prepare($request);
    }

    final public function destroy(Request $request): JsonResponse
    {
        Activity::init()->delete((int) $request->get('id', 0));

        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'OK',
            'data' => (object) [],
        ], JsonResponse::HTTP_OK);

        return $response->prepare($request);
    }
}
