<?php

namespace Tests\Application\Activity;

use App\Models\Activity;
use PHPUnit\Framework\TestCase;
use Tests\Application\MockHelper;
use Tests\Application\ValidatorHelper;
use App\Http\Controllers\ActivityController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class UpdateActivityTest extends TestCase
{
    use MockHelper;
    use ValidatorHelper;

    final public function testUpdateAnActivity(): void
    {
        $expectedData = [
            'title' => 'Create something beautiful',
            'email' => 'jonathan.joestar@jmail.com',
        ];

        $request = $this->getMockRequest();
        $request
            ->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue($expectedData));
        $request
            ->expects($this->once())
            ->method('get')
            ->with('id')
            ->will($this->returnValue(Activity::init()->random()?->id));

        $activity = new ActivityController();
        $response = $activity->update($request);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $content = json_decode($response->getContent());

        $this->validateJsonStructure($content);
        $this->assertSame($content?->status, 'Success');
        $this->assertIsObject($content?->data);

        $this->assertObjectHasAttribute('id', $content?->data);
        $this->assertSame($expectedData['title'], $content?->data?->title);
        $this->assertObjectHasAttribute('email', $content?->data);
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
        $request
            ->expects($this->once())
            ->method('toArray')
            ->will($this->returnValue([
                'title' => 'Hello world!',
            ]));

        $activity = new ActivityController();
        $activity->update($request);
    }
}
