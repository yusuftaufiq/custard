<?php

declare(strict_types=1);

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TodoListController;
use Symfony\Component\Routing\{RouteCollection, Route};

$routes = new RouteCollection();

$routes->add('show all activities', new Route(
    path: '/activity-groups',
    defaults: ['_controller' => [ActivityController::class, 'index']],
    methods: ['get'],
));

$routes->add('store an activity', new Route(
    path: '/activity-groups',
    defaults: ['_controller' => [ActivityController::class, 'store']],
    methods: ['post'],
));

$routes->add('update an activity', new Route(
    path: '/activity-groups/{id}',
    defaults: ['_controller' => [ActivityController::class, 'update']],
    requirements: ['id' => '\d+'],
    methods: ['patch'],
));

$routes->add('show an activity', new Route(
    path: '/activity-groups/{id}',
    defaults: ['_controller' => [ActivityController::class, 'show']],
    requirements: ['id' => '\d+'],
    methods: ['get'],
));

$routes->add('show all todo lists', new Route(
    path: '/todo-items',
    defaults: ['_controller' => [TodoListController::class, 'index']],
    methods: ['get'],
));

$routes->add('show a todo list', new Route(
    path: '/todo-items/{id}',
    defaults: ['_controller' => [TodoListController::class, 'show']],
    requirements: ['id' => '\d+'],
    methods: ['get'],
));

return $routes;
