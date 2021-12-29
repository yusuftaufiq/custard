<?php

namespace Tests\Application;

use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ServerBag;

trait MockHelper
{
    final public function getMockRequest(): MockObject
    {
        $request = $this->createMock(Request::class);

        /** @var MockObject */
        $request->server = $this->createMock(ServerBag::class);

        $request->server
            ->expects($this->any())
            ->method('get')
            ->with('SERVER_PROTOCOL')
            ->will($this->returnValue('HTTP/1.0'));

        return $request;
    }
}
