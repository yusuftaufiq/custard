<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Simplex\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpCache\{HttpCache, Store};

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/app.php';

$framework = new HttpCache(
    new Framework($routes),
    new Store(__DIR__ . '/../cache'),
);

$framework->handle($request)->send();
