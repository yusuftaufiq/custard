<?php

namespace Tests\Application\Activity;

use App\Http\Controllers\ActivityController;
use App\Models\Activity;
use PHPUnit\Framework\TestCase;
use Tests\Application\MockHelper;
use Tests\Application\ValidatorHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ShowActivityTest extends TestCase
{
    use MockHelper;
    use ValidatorHelper;

    final public function testShowAllActivities(): void
    {
        $expectedData = Activity::init()->all();

        $request = $this->getMockRequest();

        $activity = new ActivityController();
        $response = $activity->index($request);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $content = json_decode($response->getContent());

        $this->validateJsonStructure($content);
        $this->assertSame($content?->status, 'Success');
        $this->assertIsArray($content?->data);
        $this->assertEquals($expectedData, $content?->data);
    }

    final public function testShowAnActivity(): void
    {
        $expectedData = Activity::init()->random();

        $request = $this->getMockRequest();

        $activity = new ActivityController();
        $response = $activity->show($request, $expectedData?->id);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $content = json_decode($response->getContent());

        $this->validateJsonStructure($content);
        $this->assertSame($content?->status, 'Success');
        $this->assertIsObject($content?->data);
        $this->assertEquals($expectedData, $content?->data);
    }

    final public function testActivityNotFound(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Activity with ID 0 Not Found');

        $request = $this->getMockRequest();

        $activity = new ActivityController();
        $activity->show($request, 0);
    }
}
