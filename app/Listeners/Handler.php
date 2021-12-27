<?php

namespace App\Listeners;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\EventListener\ErrorListener;

class Handler
{
    public function register(EventDispatcher $dispatcher)
    {
        $dispatcher->addSubscriber(new ErrorListener([NotFoundListener::class, 'handler']));

        // $dispatcher->addSubscriber(new ContentLengthListener());
        // $dispatcher->addSubscriber(new GoogleListener());
        // $dispatcher->addSubscriber(new StringResponseListener());
    }
}
