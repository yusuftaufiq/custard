<?php

namespace Tests\Application\Activity;

use App\Http\Controllers\ActivityController;
use App\Models\Activity;
use PHPUnit\Framework\TestCase;
use Tests\Application\MockHelper;
use Tests\Application\ValidatorHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteActivityTest extends TestCase
{
    use MockHelper;
    use ValidatorHelper;

    final public function testDeleteAnActivity(): void
    {
        $expectedData = Activity::init()->random();

        $request = $this->getMockRequest();
        $request
            ->expects($this->once())
            ->method('get')
            ->with('id')
            ->will($this->returnValue($expectedData?->id));

        $activity = new ActivityController();
        $response = $activity->destroy($request);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $content = json_decode($response->getContent());

        $this->validateJsonStructure($content);
        $this->validateResultIsSuccess($content);
    }

    final public function testActivityNotFound(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Activity with ID 0 Not Found');

        $request = $this->getMockRequest();
        $request
            ->expects($this->once())
            ->method('get')
            ->with('id')
            ->will($this->returnValue(0));

        $activity = new ActivityController();
        $activity->destroy($request);
    }
}
