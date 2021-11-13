<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\{RequestContext, Matcher\UrlMatcher};
use Symfony\Component\HttpKernel\Controller\{ArgumentResolver, ControllerResolver};
use Simplex\Framework;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/app.php';

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

xdebug_break();

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Framework($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();
