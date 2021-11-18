<?php

namespace Simplex;

use Symfony\Component\HttpKernel\{HttpKernel, HttpKernelInterface};
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Framework extends HttpKernel
{
    public function handle(
        Request $request,
        int $type = HttpKernelInterface::MAIN_REQUEST,
        bool $catch = true
    ): Response {
        $response = parent::handle($request, $type, $catch);

        // dispatch a response event
        $this->dispatcher->dispatch(new ResponseEvent($response, $request), 'response');

        return $response;
    }
}
