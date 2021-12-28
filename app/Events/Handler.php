<?php

declare(strict_types=1);

namespace App\Events;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\{Request, Response};

class Handler
{
    public function register(EventDispatcher $dispatcher, Response $response, Request $request): void
    {
        // $dispatcher->dispatch(new ResponseEvent($response, $request), 'response');
    }
}
