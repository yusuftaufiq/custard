<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Validators\TodoListValidator;
use Core\Cache\Memcached;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

final class TodoListController
{
    final public function index(Request $request): JsonResponse
    {
        $memcached = new Memcached();
        $result = $memcached->cache("{$request->getMethod()}:{$request->getUri()}", function () use ($request) {
            $todoList = TodoList::init();
            $todoLists = match ($request->get('activity_group_id', null)) {
                null => $todoList->all(),
                default => $todoList->find(
                    column: 'activity_group_id',
                    value: (int) $request->get('activity_group_id', 0),
                ),
            };

            return json_encode([
                'status' => 'Success',
                'message' => 'OK',
                'data' => $todoLists,
            ]);
        });

        $response = new JsonResponse();
        $response->setJson($result);
        $response->setStatusCode(JsonResponse::HTTP_OK);

        return $response;
    }

    final public function show(Request $request, int $id): JsonResponse
    {
        $memcached = new Memcached();
        $result = $memcached->cache("{$request->getMethod()}:{$request->getUri()}", function () use ($id) {
            $todoList = TodoList::init();

            return json_encode([
                'status' => 'Success',
                'message' => 'OK',
                'data' => $todoList->find($id),
            ]);
        });

        $response = new JsonResponse();
        $response->setJson($result);
        $response->setStatusCode(JsonResponse::HTTP_OK);

        return $response;
    }

    final public function store(Request $request): JsonResponse
    {
        $requestTodoList = $request->toArray();

        TodoListValidator::validate()->store($requestTodoList);

        $todoList = TodoList::init();

        $id = $todoList->create($requestTodoList);

        $newTodoList = ['is_active' => 1, 'priority' => 'very-high'] + $requestTodoList + ['id' => $id];
        $newTodoList['is_active'] = (bool) $newTodoList['is_active'];

        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'Created',
            'data' => $newTodoList,
        ], JsonResponse::HTTP_CREATED);

        return $response;
    }

    final public function update(Request $request): JsonResponse
    {
        $requestTodoList = $request->toArray();

        TodoListValidator::validate()->update($requestTodoList);

        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'OK',
            'data' => TodoList::init()->update((int) $request->get('id', 0), $requestTodoList),
        ], JsonResponse::HTTP_OK);

        return $response;
    }

    final public function destroy(Request $request): JsonResponse
    {
        TodoList::init()->delete((int) $request->get('id', 0));

        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'OK',
            'data' => (object) [],
        ], JsonResponse::HTTP_OK);

        return $response;
    }
}
