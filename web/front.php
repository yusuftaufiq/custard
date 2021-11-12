<?php

// xdebug_break();
// php -dxdebug.mode=debug -dxdebug.start_with_request=yes -S localhost:8080 web/front.php
// eval(\Psy\sh());

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\{RequestContext, Matcher\UrlMatcher};
use Symfony\Component\HttpKernel\Controller\{ArgumentResolver, ControllerResolver};
use Simplex\Framework;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/app.php';

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Framework($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();
