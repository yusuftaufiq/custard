<?php

// xdebug_break();
// eval(\Psy\sh());

namespace Tests;

use Core\Framework;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

final class FrameworkTest extends TestCase
{
    final public function testNotFoundHandling(): void
    {
        $framework = $this->getFrameworkForException(new ResourceNotFoundException());

        $response = $framework->handle(new Request());

        $this->assertEquals(404, $response->getStatusCode());
    }

    final public function testErrorHandling(): void
    {
        $framework = $this->getFrameworkForException(new \RuntimeException());

        $response = $framework->handle(new Request());

        $this->assertEquals(500, $response->getStatusCode());
    }

    final public function getFrameworkForException(\RuntimeException $exception): Framework
    {
        $routes = $this->createMock(RouteCollection::class);

        $routes
            ->expects($this->once())
            ->method('getIterator')
            ->will($this->throwException($exception));

        return new Framework($routes);
    }
}
