<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Http\Controllers\ErrorController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\EventListener\ErrorListener;

class Handler
{
    public function register(EventDispatcher $dispatcher): void
    {
        $dispatcher->addSubscriber(new ErrorListener([ErrorController::class, 'exception']));

        // $dispatcher->addSubscriber(new KernelExceptionListener());
    }
}
