<?php

namespace App\Events;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\{Request, Response};

class Handler
{
    public function register(EventDispatcher $dispatcher, Response $response, Request $request)
    {
        $dispatcher->dispatch(new ResponseEvent($response, $request), 'response');
    }
}
