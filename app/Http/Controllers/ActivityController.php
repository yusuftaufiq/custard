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
        $activity = Activity::init();
        $response = new JsonResponse();

        $response->setLastModified($activity->lastModifiedTime());
        $response->setPublic();

        if ($response->isNotModified($request)) {
            return $response;
        }

        $response->setData([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $activity->all(),
        ]);
        $response->setStatusCode(JsonResponse::HTTP_OK);
        $response->prepare($request);

        return $response;
    }

    final public function show(Request $request, int $id): JsonResponse
    {
        $activity = Activity::init();
        $response = new JsonResponse();

        $response->setLastModified($activity->lastModifiedTime());
        $response->setPublic();

        if ($response->isNotModified($request)) {
            return $response;
        }

        $response->setData([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $activity->find($id),
        ]);
        $response->setStatusCode(JsonResponse::HTTP_OK);
        $response->prepare($request);

        return $response;
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
