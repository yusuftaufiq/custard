<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\{Request, RequestStack};
use Symfony\Component\Routing\{RequestContext, Matcher\UrlMatcher};
use Symfony\Component\HttpKernel\Controller\{ArgumentResolver, ControllerResolver};
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;
use Simplex\Framework;

$request = Request::createFromGlobals();
$requestStack = new RequestStack();
$routes = include __DIR__ . '/../src/app.php';

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();

$dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher, $requestStack));
$dispatcher->addSubscriber(new Simplex\StringResponseListener());
$dispatcher->addSubscriber(new Simplex\ContentLengthListener());
$dispatcher->addSubscriber(new Simplex\GoogleListener());
// $dispatcher->addSubscriber(new HttpKernel\EventListener\ErrorListener(Calendar\Controller\ErrorController::class . '::exception'));
$dispatcher->addSubscriber(new HttpKernel\EventListener\ErrorListener(fn (FlattenException $exception): Response => (
    new Response("Something went wrong! ({$exception->getMessage()})", $exception->getStatusCode())
)));

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

// $framework = new Framework($dispatcher, $controllerResolver, $requestStack, $argumentResolver);

$framework = new HttpKernel\HttpCache\HttpCache(
    new Framework($dispatcher, $controllerResolver, $requestStack, $argumentResolver),
    new HttpKernel\HttpCache\Store(__DIR__ . '/../cache'),
);

$response = $framework->handle($request);
$response->send();
