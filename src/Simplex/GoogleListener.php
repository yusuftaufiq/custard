<?php

namespace Simplex;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GoogleListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return ['response' => 'onResponse'];
    }

    public function onResponse(ResponseEvent $event)
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
