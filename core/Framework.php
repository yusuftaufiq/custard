<?php

declare(strict_types=1);

namespace Core;

use App\{Events, Listeners};
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\{Request, Response, RequestStack};
use Symfony\Component\HttpKernel\Controller\{ArgumentResolver, ControllerResolver};
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\{HttpKernel, HttpKernelInterface};
use Symfony\Component\Routing\{Matcher\UrlMatcher, RequestContext, RouteCollection};

final class Framework extends HttpKernel
{
    final public function __construct(RouteCollection $routes)
    {
        $context = new RequestContext();
        $matcher = new UrlMatcher($routes, $context);
        $requestStack = new RequestStack();

        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();

        $dispatcher = new EventDispatcher();

        $dispatcher->addSubscriber(new RouterListener($matcher, $requestStack));

        $appListenersHandler = new Listeners\Handler();
        $appListenersHandler->register($dispatcher);

        parent::__construct($dispatcher, $controllerResolver, $requestStack, $argumentResolver);
    }

    final public function handle(
        Request $request,
        int $type = HttpKernelInterface::MAIN_REQUEST,
        bool $catch = true
    ): Response {
        $response = parent::handle($request, $type, $catch);

        $appEventsHandler = new Events\Handler();
        $appEventsHandler->register($this->dispatcher, $response, $request);

        return $response;
    }
}
