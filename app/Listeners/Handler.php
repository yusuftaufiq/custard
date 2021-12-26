<?php

namespace App\Listeners;

use Symfony\Component\EventDispatcher\EventDispatcher;

class Handler
{
    public function register(EventDispatcher $dispatcher)
    {
        $dispatcher->addSubscriber(new ContentLengthListener());
        $dispatcher->addSubscriber(new GoogleListener());
        $dispatcher->addSubscriber(new StringResponseListener());
    }
}
