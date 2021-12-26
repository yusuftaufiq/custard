<?php

namespace App\Listeners;

use App\Events\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContentLengthListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return ['response' => ['onResponse', -255]];
    }

    public function onResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
    }
}
