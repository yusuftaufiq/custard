<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpCache\{HttpCache, Store};

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../routes/api.php';

$framework = new HttpCache(
    new Framework($routes),
    new Store(__DIR__ . '/../cache'),
);

$framework->handle($request)->send();
