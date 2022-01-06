<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Validators\TodoListValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

final class TodoListController
{
    final public function index(Request $request): JsonResponse
    {
        $todoList = TodoList::init();
        $todoLists = match ($request->get('activity_group_id', null)) {
            null => $todoList->all(),
            default => $todoList->find(
                column: 'activity_group_id',
                value: (int) $request->get('activity_group_id', 0),
            ),
        };

        $result = json_encode([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $todoLists,
        ]);

        $response = new JsonResponse();
        $response->setJson($result);
        $response->setStatusCode(JsonResponse::HTTP_OK);

        return $response;
    }

    final public function show(Request $request, int $id): JsonResponse
    {
        $todoList = TodoList::init();

        $result = json_encode([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $todoList->find($id),
        ]);

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

        $newTodoList = ['id' => $id] + $requestTodoList + ['is_active' => 1, 'priority' => 'very-high'];
        $newTodoList['is_active'] = (bool) $newTodoList['is_active'];

        $result = json_encode([
            'status' => 'Success',
            'message' => 'Created',
            'data' => $newTodoList,
        ]);

        $response = new JsonResponse();
        $response->setJson($result);
        $response->setStatusCode(JsonResponse::HTTP_CREATED);

        return $response;
    }

    final public function update(Request $request): JsonResponse
    {
        $requestTodoList = $request->toArray();

        TodoListValidator::validate()->update($requestTodoList);

        $result = json_encode([
            'status' => 'Success',
            'message' => 'OK',
            'data' => TodoList::init()->update((int) $request->get('id', 0), $requestTodoList),
        ]);

        $response = new JsonResponse();
        $response->setJson($result);
        $response->setStatusCode(JsonResponse::HTTP_OK);

        return $response;
    }

    final public function destroy(Request $request): JsonResponse
    {
        TodoList::init()->delete((int) $request->get('id', 0));

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
