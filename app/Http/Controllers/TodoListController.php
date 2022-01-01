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
        $todoList = new TodoList();
        $response = new JsonResponse();

        $response->setLastModified($todoList->lastModifiedTime());
        $response->setPublic();

        if ($response->isNotModified($request)) {
            return $response;
        }

        $todoLists = match ($request->get('activity_group_id', null)) {
            null => $todoList->all(),
            default => $todoList->find(
                column: 'activity_group_id',
                value: (int) $request->get('activity_group_id', 0),
            ),
        };

        $response->setData([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $todoLists,
        ]);
        $response->setStatusCode(JsonResponse::HTTP_OK);
        $response->prepare($request);

        return $response;
    }

    final public function show(Request $request, int $id): JsonResponse
    {
        $todoList = new TodoList();
        $response = new JsonResponse();

        $response->setLastModified($todoList->lastModifiedTime());
        $response->setPublic();

        if ($response->isNotModified($request)) {
            return $response;
        }

        $response->setData([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $todoList->find($id),
        ]);
        $response->setStatusCode(JsonResponse::HTTP_OK);
        $response->prepare($request);

        return $response;
    }

    final public function store(Request $request): JsonResponse
    {
        $requestTodoList = $request->toArray();

        TodoListValidator::validate()->store($requestTodoList);

        $todoList = new TodoList();

        $id = $todoList->create($requestTodoList);

        $newTodoList = $todoList->find($id);
        $newTodoList->is_active = (bool) $newTodoList->is_active;

        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'Created',
            'data' => $newTodoList,
        ], JsonResponse::HTTP_CREATED);

        return $response->prepare($request);
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

        return $response->prepare($request);
    }

    final public function destroy(Request $request): JsonResponse
    {
        TodoList::init()->delete((int) $request->get('id', 0));

        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'OK',
            'data' => (object) [],
        ], JsonResponse::HTTP_OK);

        return $response->prepare($request);
    }
}
