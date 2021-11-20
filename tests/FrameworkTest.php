<?php

// xdebug_break();
// eval(\Psy\sh());

namespace Simplex\Tests;

use Simplex\Framework;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class FrameworkTest extends TestCase
{
    public function testNotFoundHandling()
    {
        $framework = $this->getFrameworkForException(new ResourceNotFoundException());

        $response = $framework->handle(new Request());

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testErrorHandling()
    {
        $framework = $this->getFrameworkForException(new \RuntimeException());

        $response = $framework->handle(new Request());

        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testControllerResponse()
    {
        // $routes = $this->createMock(RouteCollection::class);

        // $isLapYearRoute = new Route(
        //     path: '/is_leap_year/{year}',
        //     defaults: [
        //         'year' => date('Y'),
        //         '_controller' => [LeapYearController::class, 'index'],
        //     ],
        //     requirements: [
        //         'year' => '\d+|\0',
        //     ],
        // );

        // $routes
        //     ->expects($this->once())
        //     ->method('getIterator')
        //     ->will($this->returnValue(new \ArrayIterator([
        //         $isLapYearRoute,
        //     ])));

        $routes = include __DIR__ . '/../src/app.php';

        $framework = new Framework($routes);

        $response = $framework->handle(Request::create('/is_leap_year/2000'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Yep, this is a leap year!', $response->getContent());
    }

    private function getFrameworkForException(\RuntimeException $exception)
    {
        $routes = $this->createMock(RouteCollection::class);

        $routes
            ->expects($this->once())
            ->method('getIterator')
            ->will($this->throwException($exception));

        return new Framework($routes);
    }
}
