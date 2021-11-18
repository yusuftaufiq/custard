<?php

namespace Simplex;

use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Controller\{ControllerResolverInterface, ArgumentResolverInterface};
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Framework implements HttpKernelInterface
{
    public function __construct(
        private EventDispatcherInterface $dispatcher,
        private UrlMatcherInterface $matcher,
        private ControllerResolverInterface $controllerResolver,
        private ArgumentResolverInterface $argumentResolver,
    ) {
    }

    public function handle(
        Request $request,
        int $type = HttpKernelInterface::MAIN_REQUEST,
        bool $catch = true
    ): Response {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            $response = call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            $response = new Response('Not Found', 404);
        } catch (\Exception $exception) {
            $response = new Response('An error occurred', 500);
        }

        // dispatch a response event
        $this->dispatcher->dispatch(new ResponseEvent($response, $request), 'response');

        return $response;
    }
}
