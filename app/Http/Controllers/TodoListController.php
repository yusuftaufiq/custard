<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\Http\JsonResponseHelper as JsonResponse;
use App\Models\Activity;
use App\Models\TodoList;
use App\Validators\TodoListValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class TodoListController
{
    final public function index(Request $request): Response
    {
        return JsonResponse::success(match ($request->get('activity_group_id', null)) {
            null => TodoList::init()->all(),
            default => Activity::init()->todoLists((int) $request->get('activity_group_id', 0)),
        })->prepare($request);
    }

    final public function show(Request $request, int $id): Response
    {
        return JsonResponse::success(TodoList::init()->find($id))
            ->prepare($request);
    }

    final public function store(Request $request): Response
    {
        $requestTodoList = $request->toArray();

        TodoListValidator::validate()->rules($requestTodoList);

        $todoList = TodoList::init();

        $id = $todoList->create($requestTodoList);

        return JsonResponse::success($todoList->find($id))
            ->prepare($request);
    }
}
