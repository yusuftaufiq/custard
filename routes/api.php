<?php

use Symfony\Component\Routing\{RouteCollection, Route};
use App\Http\Calendar\Controller\LeapYearController;

$routes = new RouteCollection();

$routes->add('leap_year', new Route(
    path: '/is_leap_year/{year}',
    defaults: [
        'year' => date('Y'),
        '_controller' => [LeapYearController::class, 'index'],
    ],
    requirements: [
        'year' => '\d+|\0',
    ],
));

return $routes;
