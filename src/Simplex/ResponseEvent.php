<?php

namespace Simplex;

use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Contracts\EventDispatcher\Event;

class ResponseEvent extends Event
{
    public function __construct(
        private Response $response,
        private Request $request,
    ) {
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getRequest()
    {
        return $this->request;
    }
}
