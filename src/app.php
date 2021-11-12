<?php

use Symfony\Component\Routing\{RouteCollection, Route};
use Calendar\Controller\LeapYearController;

$routes = new RouteCollection();

$routes->add('leap_year', new Route(
    path: '/is_leap_year/{year}',
    defaults: [
        'year' => null,
        '_controller' => [LeapYearController::class, 'index'],
    ],
    requirements: [
        'year' => '\d+|\0',
    ],
));

return $routes;
