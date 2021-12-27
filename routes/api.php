<?php

use Symfony\Component\Routing\{RouteCollection, Route};
use App\Http\Controllers\ActivityController;

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

return $routes;
