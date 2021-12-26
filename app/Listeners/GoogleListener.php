<?php

namespace App\Listeners;

use App\Events\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GoogleListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return ['response' => 'onResponse'];
    }

    public function onResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();

        if (
            $response->isRedirection()
            || (
                $response->headers->has('Content-Type')
                && strpos($response->headers->get('Content-Type'), 'html') === false
                )
            || 'html' !== $event->getRequest()->getRequestFormat()
        ) {
            return;
        }

        $response->setContent($response->getContent() . 'GA CODE');
    }
}
