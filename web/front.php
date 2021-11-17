<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\{RequestContext, Matcher\UrlMatcher};
use Symfony\Component\HttpKernel\Controller\{ArgumentResolver, ControllerResolver};
use Symfony\Component\EventDispatcher\EventDispatcher;
use Simplex\Framework;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/app.php';

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();
$dispatcher->addListener('response', [new Simplex\ContentLengthListener(), 'onResponse'], -255);
$dispatcher->addListener('response', [new Simplex\GoogleListener(), 'onResponse']);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Framework($dispatcher, $matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();
