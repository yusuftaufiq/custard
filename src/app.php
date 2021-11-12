<?php

use Symfony\Component\Routing;
use Calendar\Controller\LeapYearController;

$routes = new Routing\RouteCollection();

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => [LeapYearController::class, 'index'],
]));

return $routes;
