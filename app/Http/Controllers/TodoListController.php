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
        $response = new JsonResponse();

        // $response->setPublic();
        // $response->setMaxAge(3600);
        // $response->setLastModified($todoList->lastModifiedTime());
        // $response->setPublic();

        // if ($response->isNotModified($request)) {
        //     return $response;
        // }

        $memcached = new \Memcached();
        $uri = $request->getUri();
        $memcached->addServer('0.0.0.0', 11211);

        $cached = $memcached->get($uri);

        if ($cached === false) {
            $todoLists = match ($request->get('activity_group_id', null)) {
                null => $todoList->all(),
                default => $todoList->find(
                    column: 'activity_group_id',
                    value: (int) $request->get('activity_group_id', 0),
                ),
            };
            $memcached->set($uri, $todoLists, 3600);
        } else {
            $todoLists = $cached;
        }

        $response->setData([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $todoLists,
        ]);
        $response->setStatusCode(JsonResponse::HTTP_OK);
        
        return $response;
    }

    final public function show(Request $request, int $id): JsonResponse
    {
        $todoList = TodoList::init();
        $response = new JsonResponse();

        // $response->setPublic();
        // $response->setMaxAge(3600);
        // $response->setLastModified($todoList->lastModifiedTime());
        // $response->setPublic();

        // if ($response->isNotModified($request)) {
        //     return $response;
        // }

        $memcached = new \Memcached();
        $uri = $request->getUri();
        $memcached->addServer('0.0.0.0', 11211);

        $cached = $memcached->get($uri);

        if ($cached === false) {
            $todoList = $todoList->find($id);
            $memcached->set($uri, $todoList, 3600);
        } else {
            $todoList = $cached;
        }

        $response->setData([
            'status' => 'Success',
            'message' => 'OK',
            'data' => $todoList,
        ]);
        $response->setStatusCode(JsonResponse::HTTP_OK);
        
        return $response;
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
