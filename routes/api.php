<?php

declare(strict_types=1);

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TodoListController;
use Symfony\Component\Routing\{RouteCollection, Route};

$routes = new RouteCollection();

$routes->add('activities', new Route(
    path: '/activity-groups',
    defaults: ['_controller' => [ActivityController::class, 'index']],
));

$routes->add('activity', new Route(
    path: '/activity-groups/{id}',
    defaults: ['_controller' => [ActivityController::class, 'show']],
    requirements: ['id' => '\d+'],
));

$routes->add('todo_lists', new Route(
    path: '/todo-items',
    defaults: ['_controller' => [TodoListController::class, 'index']],
));

$routes->add('todo_list', new Route(
    path: '/todo-items/{id}',
    defaults: ['_controller' => [TodoListController::class, 'show']],
    requirements: ['id' => '\d+'],
));

return $routes;
