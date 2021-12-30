<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\TodoList;
use App\Validators\TodoListValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

final class TodoListController
{
    final public function index(Request $request): JsonResponse
    {
        $todoLists = match ($request->get('activity_group_id', null)) {
            null => TodoList::init()->all(),
            default => TodoList::init()->find(
                id: (int) $request->get('activity_group_id', 0),
                column: 'activity_group_id',
            ),
        };

        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $todoLists,
        ], JsonResponse::HTTP_OK);

        return $response->prepare($request);
    }

    final public function show(Request $request, int $id): JsonResponse
    {
        $response =  new JsonResponse([
            'status' => 'Success',
            'message' => 'OK',
            'data' => TodoList::init()->find($id),
        ], JsonResponse::HTTP_OK);

        return $response->prepare($request);
    }

    final public function store(Request $request): JsonResponse
    {
        $requestTodoList = $request->toArray();

        TodoListValidator::validate()->store($requestTodoList);

        $todoList = TodoList::init();

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
