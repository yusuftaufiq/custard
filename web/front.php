<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\{RequestContext, Matcher\UrlMatcher};
use Symfony\Component\HttpKernel\Controller\{ArgumentResolver, ControllerResolver};
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel;
use Simplex\Framework;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/app.php';

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new Simplex\ContentLengthListener());
$dispatcher->addSubscriber(new Simplex\GoogleListener());

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new HttpKernel\HttpCache\HttpCache(
    new Framework($dispatcher, $matcher, $controllerResolver, $argumentResolver),
    new HttpKernel\HttpCache\Store(__DIR__ . '/../cache'),
);

$response = $framework->handle($request);
$response->send();
