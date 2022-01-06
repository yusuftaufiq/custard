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
        $activities = $activity->all();

        $result = json_encode([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $activities,
        ]);

        $response = new JsonResponse();
        $response->setJson($result);
        $response->setStatusCode(JsonResponse::HTTP_OK);

        return $response;
    }

    final public function show(Request $request, int $id): JsonResponse
    {
        $activity = Activity::init();

        $result = json_encode([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $activity->find($id),
        ]);

        $response = new JsonResponse();
        $response->setJson($result);
        $response->setStatusCode(JsonResponse::HTTP_OK);

        return $response;
    }

    final public function store(Request $request): JsonResponse
    {
        $requestActivity = $request->toArray();

        ActivityValidator::validate()->store($requestActivity);

        $activity = Activity::init();
        $id = $activity->create($requestActivity);

        $result = json_encode([
            'status' => 'Success',
            'message' => 'Created',
            'data' => ['id' => $id] + $requestActivity + ['email' => null],
        ]);

        $response = new JsonResponse();
        $response->setJson($result);
        $response->setStatusCode(JsonResponse::HTTP_CREATED);

        return $response;
    }

    final public function update(Request $request): JsonResponse
    {
        $requestActivity = $request->toArray();

        ActivityValidator::validate()->update($requestActivity);

        $result = json_encode([
            'status' => 'Success',
            'message' => 'OK',
            'data' => Activity::init()->update((int) $request->get('id', 0), $requestActivity),
        ]);

        $response = new JsonResponse();
        $response->setJson($result);
        $response->setStatusCode(JsonResponse::HTTP_OK);

        return $response;
    }

    final public function destroy(Request $request): JsonResponse
    {
        Activity::init()->delete((int) $request->get('id', 0));

        $result = json_encode([
            'status' => 'Success',
            'message' => 'OK',
            'data' => (object) [],
        ]);

        $response = new JsonResponse();
        $response->setJson($result);
        $response->setStatusCode(JsonResponse::HTTP_OK);

        return $response;
    }
}
